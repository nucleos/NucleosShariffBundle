# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 3.3.0 - 2021-12-08


-----

### Release Notes for [3.3.0](https://github.com/nucleos/NucleosShariffBundle/milestone/3)

Feature release (minor)

### 3.3.0

- Total issues resolved: **0**
- Total pull requests resolved: **6**
- Total contributors: **1**

#### dependency

 - [608: Add symfony 6 support](https://github.com/nucleos/NucleosShariffBundle/pull/608) thanks to @core23
 - [607: Drop symfony 4 support](https://github.com/nucleos/NucleosShariffBundle/pull/607) thanks to @core23
 - [593: Drop PHP 7 support](https://github.com/nucleos/NucleosShariffBundle/pull/593) thanks to @core23

#### Enhancement

 - [606: Drop node-sass](https://github.com/nucleos/NucleosShariffBundle/pull/606) thanks to @core23
 - [603: Update tools and use make to run them](https://github.com/nucleos/NucleosShariffBundle/pull/603) thanks to @core23

#### Bug

 - [364: Throw LogicException when rendering block without template](https://github.com/nucleos/NucleosShariffBundle/pull/364) thanks to @core23

## 5.2.0 - TBD

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.


## 5.1.1

### 🐛 Bug Fixes

- Fix tagging services [@core23] ([#187])

## 5.1.0

### 📦 Dependencies

- Add support for sonata-project/block-bundle 3 [@core23] ([#171])

## 5.0.0

### Changes

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

### Changes

- Add missing strict file header [@core23] ([#49])
- Removed deprecated name argument from block constructor [@core23] ([#15])

### 🚀 Features

- Move configuration to PHP [@core23] ([#70])
- Add combined assets [@core23] ([#59])
- Port heise shariff code [@core23] ([#29])
- Use latest block bundle for auto-registration of blocks [@core23] ([#21])
- Use new block signatures [@core23] ([#14])

### 🐛 Bug Fixes

- Fix wrong dependency injection of ShariffShareBlockService [@core23] ([#50])
- Remove deprecated twig calls [@core23] ([#23])

### 📦 Dependencies

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
