# 5.0.0

## Changes

- Renamed namespace `Core23\ShariffBundle` to `Nucleos\ShariffBundle` after move to [@nucleos]

  Run

  ```
  $ composer remove core23/shariff-bundle
  ```

  and

  ```
  $ composer require nucleos/shariff-bundle
  ```

  to update.

  Run

  ```
  $ find . -type f -exec sed -i '.bak' 's/Core23\\ShariffBundle/Nucleos\\ShariffBundle/g' {} \;
  ```

  to replace occurrences of `Core23\ShariffBundle` with `Nucleos\ShariffBundle`.

  Run

  ```
  $ find -type f -name '*.bak' -delete
  ```

  to delete backup files created in the previous step.

- Add missing strict file header @core23 (#49)
- Use default public setting for all actions @core23 (#16)
- Removed deprecated name argument from block constructor @core23 (#15)

## 🚀 Features

- Port heise shariff code @core23 (#29)
- Use latest block bundle for auto-registration of blocks @core23 (#21)
- Use new block signatures @core23 (#14)

## 🐛 Bug Fixes

- Fix wrong dependency injection of ShariffShareBlockService @core23 (#50)
- Remove deprecated twig calls @core23 (#23)

## 📦 Dependencies

- Add support for symfony 5 @core23 (#25)
- Bump sonata block version @core23 (#32)
- Drop support for symfony < 4.2 @core23 (#34)
- Removed admin bundle dependency @core23 (#20)
