{ pkgs ? import <nixpkgs> {} }:

pkgs.mkShell {
  buildInputs = with pkgs; [
    php84
    phpPackages.composer
    nodejs_23
  ];

  shellHook = ''
    run_task() {
      php artisan serve > /dev/null 2>&1 &
      npm run dev > /dev/null 2>&1 &
    }

    end_task() {
      pkill -f 'php artisan serve'
      pkill -f 'npm run dev'
    }

    if [ ! -f 'artisan' ] && [ ! -f 'composer.json' ] && [ ! -f 'package.json' ]; then
      echo 'Make sure you are in the root of the project.'
      exit 1
    fi

    if [ ! -d 'vendor/' ] || [ ! -d 'node_modules/' ]; then
      read -r -p "Install dependencies? [y/N] " response
      case "$response" in
          [yY][eE][sS]|[yY])
              composer install
              npm install
              npm run build
              php artisan migrate
              ;;
          *)
              exit 1
              ;;
      esac
    fi

    if [ ! -f .env ]; then
      cp .env.example .env
      php artisan key:generate
    fi

    echo "Use 'run_task' to start the server and 'end_task' to stop it."
  '';
}