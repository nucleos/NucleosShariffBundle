# 5.1.1

## 🐛 Bug Fixes

- Fix tagging services [@core23] ([#187])

# 5.1.0

## 📦 Dependencies

- Add support for sonata-project/block-bundle 3 [@core23] ([#171])

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

- Add missing strict file header [@core23] ([#49])
- Use default public setting for all actions [@core23] ([#16])
- Removed deprecated name argument from block constructor [@core23] ([#15])

## Changes

- Add missing strict file header [@core23] ([#49])
- Removed deprecated name argument from block constructor [@core23] ([#15])

## 🚀 Features

- Move configuration to PHP [@core23] ([#70])
- Add combined assets [@core23] ([#59])
- Port heise shariff code [@core23] ([#29])
- Use latest block bundle for auto-registration of blocks [@core23] ([#21])
- Use new block signatures [@core23] ([#14])

## 🐛 Bug Fixes

- Fix wrong dependency injection of ShariffShareBlockService [@core23] ([#50])
- Remove deprecated twig calls [@core23] ([#23])

## 📦 Dependencies

- Add support for symfony 5 [@core23] ([#25])
- Bump sonata block version [@core23] ([#32])
- Drop support for symfony < 4.2 [@core23] ([#34])
- Removed admin bundle dependency [@core23] ([#20])

[#171]: https://github.com/nucleos/NucleosShariffBundle/pull/171
[#70]: https://github.com/nucleos/NucleosShariffBundle/pull/70
[#59]: https://github.com/nucleos/NucleosShariffBundle/pull/59
[#50]: https://github.com/nucleos/NucleosShariffBundle/pull/50
[#49]: https://github.com/nucleos/NucleosShariffBundle/pull/49
[#34]: https://github.com/nucleos/NucleosShariffBundle/pull/34
[#32]: https://github.com/nucleos/NucleosShariffBundle/pull/32
[#29]: https://github.com/nucleos/NucleosShariffBundle/pull/29
[#25]: https://github.com/nucleos/NucleosShariffBundle/pull/25
[#23]: https://github.com/nucleos/NucleosShariffBundle/pull/23
[#21]: https://github.com/nucleos/NucleosShariffBundle/pull/21
[#20]: https://github.com/nucleos/NucleosShariffBundle/pull/20
[#16]: https://github.com/nucleos/NucleosShariffBundle/pull/16
[#15]: https://github.com/nucleos/NucleosShariffBundle/pull/15
[#14]: https://github.com/nucleos/NucleosShariffBundle/pull/14
[@nucleos]: https://github.com/nucleos
[@core23]: https://github.com/core23
[#187]: https://github.com/nucleos/NucleosShariffBundle/pull/187
