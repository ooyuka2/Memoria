# Frandre

[![Build Status by Travis CI](https://travis-ci.org/sairoutine/Frandre.svg?branch=master)](https://travis-ci.org/sairoutine/Frandre)
[![The MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

[![Frandre](http://sairoutine.github.io/Frandre/assets/img/sample.png)](http://sairoutine.github.io/Frandre/)

"Frandre"��"[Honoka](https://github.com/windyakin/Honoka)"�����ɂ������{����������\���ł���Bootstrap�e�[�}�ł��B

## About "Frandre"

�ʏ��[Bootstrap](http://getbootstrap.com/)�ł́C���{��̃t�H���g�w��╶���T�C�Y�͍œK�Ƃ͂����܂���B"Honoka"�͂����Bootstrap���x�[�X�ɁC���{��\���ɓK�����t�H���g�w���C�����T�C�Y�Ɋւ���R�[�h��ǋL����Bootstrap�e�[�}�̈�ł��B

"Frandre"��"Honoka"�����ɁA[Ubuntu](https://www.ubuntulinux.jp/)���ۂ��z�F��K�p�����e�[�}�ł��B

## Live Demo

 * [http://sairoutine.github.io/Frandre/bootstrap-ja.html](http://sairoutine.github.io/Frandre/bootstrap-ja.html) (���{�ꃌ�C�A�E�g)
 * [http://sairoutine.github.io/Frandre/bootstrap.html](http://sairoutine.github.io/Frandre/bootstrap.html) (�p�ꃌ�C�A�E�g)

## Getting Started

### Download

[Releases](https://github.com/sairoutine/Frandre/releases)����ŐV�ł��_�E�����[�h���Ă��������B

### Bower

[Bower](http://bower.io/)����C���X�g�[�����邱�Ƃ��ł��܂��B

```
bower install --save-dev Frandre#(version)
```

``(version)``�ɂ̓o�[�W�����ԍ����w�肵�܂�(ex. ``Frandre#1.0.1``)�BFrandre�̍ŐV�o�[�W�����ԍ���[Relases](https://github.com/sairoutine/Frandre/releases)����m�F���Ă��������B

## Usage

Frandre�͒P�Ȃ�Bootstrap�e�[�}�ɂ����߂��Ȃ����߁C��{�I�Ȏg�����͖{��Bootstrap�ƂقƂ�Ǖς��܂���B����Ĉȉ��ɏ������Ƃ�[�{��Bootstrap](http://getbootstrap.com/getting-started/)����̈��p�C�������͂��̈ꕔ��ύX�������̂ł��B�p�ӂ��ꂽCSS�N���X��R���|�[�l���g�ȂǁC���ڍׂȎg�����̃h�L�������g�͖{��Bootstrap�̊e�탊�t�@�����X�y�[�W�������ɂȂ邱�Ƃ𐄏����܂��B

 * [CSS](http://getbootstrap.com/css/)
 * [Components](http://getbootstrap.com/components/)
 * [JavaScript](http://getbootstrap.com/javascript/)

### Package

�z�z���Ă���zip�t�@�C���̓��e���͈ȉ��̂Ƃ���ł��B``bootstrap.min.*``�Ƃ������悤�ɁC�t�@�C������``min``�����t�@�C���́C���s��C���f���g�E�X�y�[�V���O���Ȃ�����(minify���ꂽ)�R�[�h�ŁC���[�U���E�F�u�y�[�W��ǂݍ��ލۂ̓]���ʂ����Ȃ����邱�Ƃ��ł��܂��B�ʏ�͂���``bootstrap.min.*``���g�����Ƃ��������߂��܂��B

```
honoka/
���� bootstrap.html
���� css/
��   ���� bootstrap.css
��   ���� bootstrap.min.css
���� fonts/
��   ���� glyphicons-halflings-regular.eot
��   ���� glyphicons-halflings-regular.svg
��   ���� glyphicons-halflings-regular.ttf
��   ���� glyphicons-halflings-regular.woff
��   ���� glyphicons-halflings-regular.woff2
���� js/
     ���� bootstrap.js
     ���� bootstrap.min.js
```

### Basic Template

Bootstrap�������ăE�F�u�y�[�W���쐬����ۂɊ�{�ƂȂ�HTML�����͈ȉ��̂悤�ɂȂ�܂��BCSS��JavaScript�̃t�@�C���p�X�͊��ɍ��킹�ĕύX����K�v������܂��B

```html
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <h1>Hello, world!</h1>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
```

### Do you hate "YuGothic"?

�������Ȃ������{��t�H���g�ɟ��S�V�b�N���w�肵�����Ȃ��ꍇ�C���̗v�f�ɑ΂���``.no-thank-yu``(��``you``�ł͂Ȃ�``yu``)���w�肷�邱�Ƃş��S�V�b�N�̎w��͂���Ȃ��Ȃ�CWindows�ł���΃��C���I�CMac OS X�ł���΃q���M�m�p�S��D��I�Ɏg�p����悤�ɂȂ�܂��B

�Ⴆ�΃y�[�W�S�̂ɑ΂��ğ��S�V�b�N��p�������Ȃ��ꍇ�́C``<body>``�ɑ΂���``.no-thank-yu``���w��(``<body class="no-thank-yu">``)���邱�ƂŁC�y�[�W�S�̂ş��S�V�b�N�͎g�p����Ȃ��Ȃ�܂��B

## Build

�r���h�̕��@�ɂ��Ă�Honoka�� [Wiki](https://github.com/windyakin/Honoka/wiki) ���������������B

## License

[MIT License](LICENSE)

## Author

 * windyakin ([windyakin.net](http://windyakin.net/))

## Editor

 * sairoutine ([sai-chan.com](http://sai-chan.com/))
