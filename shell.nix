{ pkgs ? import <nixpkgs> {} }:

pkgs.mkShell {
  buildInputs = with pkgs; [
    php84
    phpPackages.composer
    nodejs_23
  ];

  shellHook = ''
    if [ ! -f artisan ] || [ ! -f composer.json ]; then
      echo 'Make sure you are in the root of the project.'
      exit 1
    fi

    end_task() {
      pkill -f 'php artisan serve'
      pkill -f 'npm run dev'
    }

    php artisan serve > /dev/null 2>&1 &
    npm run dev > /dev/null 2>&1 &
  '';
}