<div class="container">
<h1 class="co-12 text-primary">表示例</h1>

  <!-- Typography
  ================================================== -->
  <section class="co-12 bs-docs-section">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <!-- <h1 id="typography">Typography</h1> -->
        </div>
      </div>
    </div>

    <!-- Headings -->

    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <h2>本文サンプル</h2>
          <p>グスコーブドリは、<a href="#">イーハトーヴ</a>の大きな森のなかに生まれました。おとうさんは、グスコーナドリという名高い木こりで、どんな大きな木でも、まるで赤ん坊を寝かしつけるようにわけなく切ってしまう人でした。</p>
          <p><small>テキストのこの行は、細字として扱われることを意味します。</small></p>
          <p>テキストの次のコードは、<strong>太字のテキストとしてレンダリングされます</strong>。</p>
          <p>テキストの次のコードは、 <em>斜体のテキストとしてレンダリングされます</em>。</p>
          <p><abbr title="Nippon Telegraph and Telephone Corporation">NTT</abbr>の日本語名称は「日本電信電話」です。</p>
        </div>

      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <h2>Emphasis classes</h2>
          <p class="text-muted">春はあけぼの。やうやう白くなりゆく山際、少しあかりて、紫だちたる雲の細くたなびきたる。</p>
          <p class="text-primary">夏は夜。月の頃はさらなり。闇もなほ、蛍のおほく飛びちがひたる。</p>
          <p class="text-warning">また、ただ一つ二つなど、ほのかにうち光りて行くもをかし。雨など降るもをかし。</p>
          <p class="text-danger">秋は夕暮れ。夕日のさして山の端いと近うなりたるに、烏の、寝どころへ行くとて、三つ四つ、二つ三つなど飛び急ぐさへあはれなり。</p>
          <p class="text-success">まいて、雁などのつらねたるが、いと小さく見ゆるは、いとをかし。 </p>
          <p class="text-info">日入り果てて、風の音、虫の音など、はた言ふべきにあらず。</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <h1>見出しTitle 1</h1>
          <h2>見出しTitle 2</h2>
          <h3>見出しTitle 3</h3>
          <h4>見出しTitle 4</h4>
          <h5>見出しTitle 5</h5>
          <h6>見出しTitle 6</h6>
          <h3>
            見出し
            <small class="text-muted">サブテキスト</small>
          </h3>
          <p class="lead">色は匂へど散りぬるを 我が世誰そ常ならむ。</p>
        </div>
      </div>
    </div>


  <!-- Buttons
  ================================================== -->
  <section class="co-12 bs-docs-section">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-12">
          <h1 id="buttons">Buttons</h1>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-7">

        <p class="bs-component">
          <button type="button" class="btn btn-default">default</button>
          <button type="button" class="btn btn-primary">Primary</button>
          <button type="button" class="btn btn-secondary">Secondary</button>
          <button type="button" class="btn btn-success">Success</button>
          <button type="button" class="btn btn-info">Info</button>
          <button type="button" class="btn btn-warning">Warning</button>
          <button type="button" class="btn btn-danger">Danger</button>
          <button type="button" class="btn btn-link">Link</button>
        </p>

        <p class="bs-component">
          <button type="button" class="btn btn-default disabled">default</button>
          <button type="button" class="btn btn-primary disabled">Primary</button>
          <button type="button" class="btn btn-secondary disabled">Secondary</button>
          <button type="button" class="btn btn-success disabled">Success</button>
          <button type="button" class="btn btn-info disabled">Info</button>
          <button type="button" class="btn btn-warning disabled">Warning</button>
          <button type="button" class="btn btn-danger disabled">Danger</button>
          <button type="button" class="btn btn-link disabled">Link</button>
        </p>

        <p class="bs-component">
          <button type="button" class="btn btn-outline-default">default</button>
          <button type="button" class="btn btn-outline-primary">Primary</button>
          <button type="button" class="btn btn-outline-secondary">Secondary</button>
          <button type="button" class="btn btn-outline-success">Success</button>
          <button type="button" class="btn btn-outline-info">Info</button>
          <button type="button" class="btn btn-outline-warning">Warning</button>
          <button type="button" class="btn btn-outline-danger">Danger</button>
        </p>

        <div class="bs-component">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-primary">Primary</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
              </div>
            </div>
          </div>

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-success">Success</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
              </div>
            </div>
          </div>

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-info">Info</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop3" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop3">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
              </div>
            </div>
          </div>

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-danger">Danger</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop4" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop4">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
              </div>
            </div>
          </div>
        </div>

        <div class="bs-component">
          <button type="button" class="btn btn-primary btn-lg">Large button</button>
          <button type="button" class="btn btn-primary">Default button</button>
          <button type="button" class="btn btn-primary btn-sm">Small button</button>
        </div>

      </div>
      <div class="col-lg-5">

        <p class="bs-component">
          <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>
        </p>

        <div class="bs-component" style="margin-bottom: 15px;">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary active">
              <input type="checkbox" checked autocomplete="off"> Active
            </label>
            <label class="btn btn-primary">
              <input type="checkbox" autocomplete="off"> Check
            </label>
            <label class="btn btn-primary">
              <input type="checkbox" autocomplete="off"> Check
            </label>
          </div>
        </div>

        <div class="bs-component" style="margin-bottom: 15px;">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary active">
              <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
            </label>
            <label class="btn btn-primary">
              <input type="radio" name="options" id="option2" autocomplete="off"> Radio
            </label>
            <label class="btn btn-primary">
              <input type="radio" name="options" id="option3" autocomplete="off"> Radio
            </label>
          </div>
        </div>

        <div class="bs-component">
          <div class="btn-group-vertical" data-toggle="buttons">
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
          </div>
        </div>

        <div class="bs-component" style="margin-bottom: 15px;">
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary">Left</button>
            <button type="button" class="btn btn-secondary">Middle</button>
            <button type="button" class="btn btn-secondary">Right</button>
          </div>
        </div>

        <div class="bs-component" style="margin-bottom: 15px;">
          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
              <button type="button" class="btn btn-secondary">1</button>
              <button type="button" class="btn btn-secondary">2</button>
              <button type="button" class="btn btn-secondary">3</button>
              <button type="button" class="btn btn-secondary">4</button>
            </div>
            <div class="btn-group mr-2" role="group" aria-label="Second group">
              <button type="button" class="btn btn-secondary">5</button>
              <button type="button" class="btn btn-secondary">6</button>
              <button type="button" class="btn btn-secondary">7</button>
            </div>
            <div class="btn-group" role="group" aria-label="Third group">
              <button type="button" class="btn btn-secondary">8</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

<canvas id="barChart"></canvas>



  <!-- Tables
  ================================================== -->
  <section class="co-12 bs-docs-section">

    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="tables">Tables</h1>
        </div>

        <div class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Type</th>
                <th scope="col">名前</th>
                <th scope="col">誕生日</th>
                <th scope="col">血液型</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-active">
                <th scope="row">Active</th>
                <td>高坂穂乃果</td>
                <td>8月3日(獅子座)</td>
                <td>O型</td>
              </tr>
              <tr>
                <th scope="row">Default</th>
                <td>東條希</td>
                <td>6月9日(双子座)</td>
                <td>O型</td>
              </tr>
              <tr class="table-primary">
                <th scope="row">Primary</th>
                <td>園田海未</td>
                <td>3月15日(魚座)</td>
                <td>A型</td>
              </tr>
              <tr class="table-secondary">
                <th scope="row">Secondary</th>
                <td>南ことり</td>
                <td>9月12日(乙女座)</td>
                <td>O型</td>
              </tr>
              <tr class="table-success">
                <th scope="row">Success</th>
                <td>小泉花陽</td>
                <td>1月17日(山羊座)</td>
                <td>B型</td>
              </tr>
              <tr class="table-danger">
                <th scope="row">Danger</th>
                <td>西木野真姫</td>
                <td>4月19日(牡羊座)</td>
                <td>AB型</td>
              </tr>
              <tr class="table-warning">
                <th scope="row">Warning</th>
                <td>星空凛</td>
                <td>11月1日(蠍座)</td>
                <td>A型</td>
              </tr>
              <tr class="table-info">
                <th scope="row">Info</th>
                <td>絢瀬絵里</td>
                <td>10月21日(天秤座)</td>
                <td>B型</td>
              </tr>
              <tr class="table-light">
                <th scope="row">Light</th>
                <td>矢澤にこ</td>
                <td>7月22日(蟹座)</td>
                <td>A型</td>
              </tr>
              <tr class="table-dark">
                <th scope="row">Dark</th>
                <td>アルパカ</td>
                <td>?月?日(？座)</td>
                <td>?型</td>
              </tr>
            </tbody>
          </table>
        </div><!-- /example -->
      </div>
    </div>
  </section>

  <!-- Forms
  ================================================== -->
  <section class="co-12 bs-docs-section">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="forms">Forms</h1>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="bs-component">
          <form>
            <fieldset>
              <legend>Legend</legend>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">メールアドレス</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">ここで入力したメールアドレスは公開されません</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">パスワード</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="exampleSelect1">選択</label>
                <select class="form-control" id="exampleSelect1">
                  <option>高坂穂乃果</option>
                  <option>絢瀬絵里</option>
                  <option>南ことり</option>
                  <option>園田海未</option>
                  <option>星空凛</option>
                  <option>西木野真姫</option>
                  <option>東條希</option>
                  <option>小泉花陽</option>
                  <option>矢澤にこ</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleSelect2">複数選択</label>
                <select multiple class="form-control" id="exampleSelect2">
                  <option>高坂穂乃果</option>
                  <option>絢瀬絵里</option>
                  <option>南ことり</option>
                  <option>園田海未</option>
                  <option>星空凛</option>
                  <option>西木野真姫</option>
                  <option>東條希</option>
                  <option>小泉花陽</option>
                  <option>矢澤にこ</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleTextarea">テキストエリア</label>
                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">ファイル選択</label>
                <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">上にある入力欄に関するブロックレベルのヘルプテキストです。少し薄い文字色で表示されて、1行に収まらない場合は折り返して表示されます。</small>
              </div>
              <fieldset class="form-group">
                <legend>ラジオボタン</legend>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    オプション1
                  </label>
                </div>
                <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                    オプション2
                  </label>
                </div>
                <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                    オプション3 (Disable)
                  </label>
                </div>
              </fieldset>
              <fieldset class="form-group">
                <legend>チェックボックス</legend>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" checked>
                    オプション1
                  </label>
                </div>
                <div class="form-check disabled">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" disabled>
                    オプション2 (Disable)
                  </label>
                </div>
              </fieldset>
              <button type="submit" class="btn btn-primary">送信</button>
            </fieldset>
          </form>
        </div>
      </div>
      <div class="col-lg-4 offset-lg-1">

        <form class="bs-component">
          <div class="form-group">
            <fieldset disabled>
              <label class="control-label" for="disabledInput">Disabled 入力欄</label>
              <input class="form-control" id="disabledInput" type="text" placeholder="Disabled の入力欄です" disabled="">
            </fieldset>
          </div>

          <div class="form-group">
            <fieldset>
              <label class="control-label" for="readOnlyInput">Readonly 入力欄</label>
              <input class="form-control" id="readOnlyInput" type="text" placeholder="Readonly の入力欄です" readonly>
            </fieldset>
          </div>

          <div class="form-group has-success">
            <label class="form-control-label" for="inputSuccess1">Valid input</label>
            <input type="text" value="elichica" class="form-control is-valid" id="inputValid">
            <div class="valid-feedback">入力したIDは使用可能です</div>
          </div>

          <div class="form-group has-danger">
            <label class="form-control-label" for="inputDanger1">Invalid input</label>
            <input type="text" value="elichica" class="form-control is-invalid" id="inputInvalid">
            <div class="invalid-feedback">入力したIDは既に使用済みです</div>
          </div>

          <div class="form-group">
            <label class="col-form-label col-form-label-lg" for="inputLarge">大きい入力欄</label>
            <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" id="inputLarge">
          </div>

          <div class="form-group">
            <label class="col-form-label" for="inputDefault">通常の入力欄</label>
            <input type="text" class="form-control" placeholder="Default input" id="inputDefault">
          </div>

          <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="inputSmall">小さい入力欄</label>
            <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" id="inputSmall">
          </div>

          <div class="form-group">
            <label class="control-label">Input addons</label>
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">&yen;</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                  <span class="input-group-text">百万円</span>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="bs-component">
          <fieldset>
            <legend>Custom forms</legend>
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
                <label class="custom-control-label" for="customRadio1">Custom forms を利用すると</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                <label class="custom-control-label" for="customRadio2">全OSで共通のデザインになります</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" disabled>
                <label class="custom-control-label" for="customRadio3">選択できない選択肢</label>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                <label class="custom-control-label" for="customCheck1">チェックボックスも同様です</label>
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck2" disabled>
                <label class="custom-control-label" for="customCheck2">選択できない選択肢</label>
              </div>
            </div>
            <div class="form-group">
              <select class="custom-select">
                <option selected>選択してください</option>
                <option value="1">Pritemps</option>
                <option value="2">BiBi</option>
                <option value="3">lily white</option>
              </select>
            </div>
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile02">
                  <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text" id="">Upload</span>
                </div>
              </div>
            </div>
          </fieldset>
        </div>

      </div>
    </div>
  </section>

  <!-- Navs
  ================================================== -->
  <section class="co-12 bs-docs-section">

    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="navs">Navs</h1>
        </div>
      </div>
    </div>

    <div class="row" style="margin-bottom: 2rem;">
      <div class="col-lg-12">
        <h2 id="nav-tabs">Tabs</h2>
        <div class="bs-component">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#home">坊っちゃん</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#profile">愚見数則</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">人間失格</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">宮沢賢治</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" data-toggle="tab" href="#dropdown1">雨ニモマケズ</a>
                <a class="dropdown-item" data-toggle="tab" href="#dropdown2">春と修羅(序)</a>
                <a class="dropdown-item" data-toggle="tab" href="#dropdown3">銀河鉄道の夜</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" data-toggle="tab" href="#dropdown4">よだかの星</a>
              </div>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade show active" id="home">
              <p>親讓りの無鐵砲で小供の時から損ばかりして居る。小學校に居る時分學校の二階から飛び降りて一週間程腰を拔かした事がある。なぜそんな無闇（むやみ）をしたと聞く人があるかも知れぬ。別段深い理由でもない。新築の二階から首を出して居たら、同級生の一人が冗談に、いくら威張つても、そこから飛び降りる事は出來まい。弱虫やーい。と囃（はや）したからである。小使（こづかひ）に負ぶさつて歸つて來た時、おやぢが大きな眼をして二階位（にかいぐらゐ）から飛び降りて腰を拔かす奴があるかと云つたから、此次（このつぎ）は拔かさずに飛んで見せますと答へた。</p>
            </div>
            <div class="tab-pane fade" id="profile">
              <p>昔しの書生は、笈を負ひて四方に遊歴し、此人ならばと思ふ先生の許に落付く、故に先生を敬ふ事、父兄に過ぎたり、先生も亦弟子に対する事、真の子の如し、是でなくては真の教育といふ事は出来ぬなり、今の書生は学校を旅屋の如く思ふ、金を出して暫らく逗留するに過ぎず、厭になればすぐに宿を移す、かゝる生徒に対する校長は、宿屋の主人の如く、教師は番頭丁稚なり、主人たる校長すら、時には御客の機嫌を取らねばならず、況んや番頭丁稚をや、薫陶所か解雇されざるを以て幸福と思ふ位なり、生徒の増長し教員の下落するは当前の事なり。</p>
            </div>
            <div class="tab-pane fade" id="dropdown1">
              <p>雨ニモマケズ 風ニモマケズ 雪ニモ夏ノ暑サニモマケヌ 丈夫ナカラダヲモチ 慾ハナク 決シテ瞋ラズ イツモシズカニワラッテイル 一日ニ玄米四合ト 味噌ト少シノ野菜ヲタベ アラユルコトヲ ジブンヲカンジョウニ入レズニ ヨクミキキシワカリ ソシテワスレズ</p>
            </div>
            <div class="tab-pane fade" id="dropdown2">
              <p>わたくしといふ現象は 假定された有機交流電燈の ひとつの青い照明です （あらゆる透明な幽霊の複合体） 風景やみんなといっしょに せはしくせはしく明滅しながら いかにもたしかにともりつづける 因果交流電燈の ひとつの青い照明です （ひかりはたもち、その電燈は失はれ）</p>
            </div>
            <div class="tab-pane fade" id="dropdown3">
              <p>「ではみなさんは、さういふふうに川だと云はれたり、乳の流れたあとだと云はれたりしてゐたこのぼんやりと白いものがほんたうは何かご承知ですか。」先生は、黒板に吊した大きな黒い星座の図の、上から下へ白くけぶった銀河帯のやうなところを指しながら、みんなに問をかけました。</p>
              <p>カムパネルラが手をあげました。それから四五人手をあげました。ジョバンニも手をあげやうとして、急いでそのまゝやめました。たしかにあれがみんな星だと、いつか雑誌で読んだのでしたが、このごろはジョバンニはまるで毎日教室でもねむく、本を読むひまも読む本もないので、なんだかどんなこともよくわからないといふ気持ちがするのでした。</p>
            </div>
            <div class="tab-pane fade" id="dropdown4">
              <p>よだかは、実にみにくい鳥です。</p>
              <p>顔は、ところどころ、味噌をつけたようにまだらで、くちばしは、ひらたくて、耳までさけています。</p>
              <p>足は、まるでよぼよぼで、一間とも歩けません。</p>
              <p>ほかの鳥は、もう、よだかの顔を見ただけでも、いやになってしまうという工合でした。</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <h2 id="nav-pills">Pills</h2>
        <div class="bs-component">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" href="#">Active</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        </div>
        <br>
        <div class="bs-component">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">Active</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <h2 id="nav-breadcrumbs">Breadcrumbs</h2>
        <div class="bs-component">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">Home</li>
          </ol>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Library</li>
          </ol>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active">Data</li>
          </ol>
        </div>
      </div>

      <div class="col-lg-12">
        <h2 id="pagination">Pagination</h2>
        <div class="bs-component">
          <div>
            <ul class="pagination">
              <li class="page-item disabled">
                <a class="page-link" href="#">&laquo;</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">5</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">&raquo;</a>
              </li>
            </ul>
          </div>

          <div>
            <ul class="pagination pagination-lg">
              <li class="page-item disabled">
                <a class="page-link" href="#">&laquo;</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">5</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">&raquo;</a>
              </li>
            </ul>
          </div>

          <div>
            <ul class="pagination pagination-sm">
              <li class="page-item disabled">
                <a class="page-link" href="#">&laquo;</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">5</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">&raquo;</a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Indicators
  ================================================== -->
  <section class="co-12 bs-docs-section">

    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="indicators">Indicators</h1>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <h2>Alerts</h2>
        <div class="bs-component">
          <div class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Warning!</h4>
            <p class="mb-0">要求された処理は正常に完了できませんでした。このエラーについての詳細は<a href="#" class="alert-link">こちらのドキュメントを参照してください</a>。</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>エラー</strong> <a href="#" class="alert-link">いくつかの項目を見直して</a> 再度投稿してください
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>完了</strong> 記事「<a href="#" class="alert-link">国立音ノ木坂学院について</a>」を公開しました
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Tips</strong> 生徒手帳には<a href="#" class="alert-link">講堂の使用には許可が必要</a>と書いてあります
          </div>
        </div>
      </div>
    </div>
    <div>
      <h2>Badges</h2>
      <div class="bs-component" style="margin-bottom: 40px;">
        <span class="badge badge-primary">Primary</span>
        <span class="badge badge-secondary">Secondary</span>
        <span class="badge badge-success">Success</span>
        <span class="badge badge-danger">Danger</span>
        <span class="badge badge-warning">Warning</span>
        <span class="badge badge-info">Info</span>
        <span class="badge badge-light">Light</span>
        <span class="badge badge-dark">Dark</span>
      </div>
      <div class="bs-component">
        <span class="badge badge-pill badge-primary">Primary</span>
        <span class="badge badge-pill badge-secondary">Secondary</span>
        <span class="badge badge-pill badge-success">Success</span>
        <span class="badge badge-pill badge-danger">Danger</span>
        <span class="badge badge-pill badge-warning">Warning</span>
        <span class="badge badge-pill badge-info">Info</span>
        <span class="badge badge-pill badge-light">Light</span>
        <span class="badge badge-pill badge-dark">Dark</span>
      </div>
    </div>
  </section>

  <!-- Progress bars
  ================================================== -->
  <section class="co-12 bs-docs-section">

    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="progress">Progress</h1>
        </div>

        <h3 id="progress-basic">Basic</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>

        <h3 id="progress-alternatives">Contextual alternatives</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>

        <h3 id="progress-multiple">Multiple bars</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-success" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>

        <h3 id="progress-striped">Striped</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>

        <h3 id="progress-animated">Animated</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Containers
  ================================================== 
  <section class="co-12 bs-docs-section">

    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="containers">Containers</h1>
        </div>
        <div class="bs-component">
          <div class="jumbotron">
            <h1 class="display-3">音ノ木坂学院へようこそ</h1>
            <p class="lead">音ノ木坂学院は秋葉原と神田と神保町の3つの街の中心部にある国立高校です。</p>
            <hr class="my-4">
            <p>創立は明治期、100年をかぞえる伝統校でありながらも、創立者の目指した自由な校風により常に新しさも兼ね揃えてきました。</p>
            <p class="lead">
              <a class="btn btn-primary btn-lg" href="#" role="button">もっと詳しく</a>
            </p>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-lg-12">
        <h2>List groups</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              夢なき夢は夢じゃない
              <span class="badge badge-primary badge-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Anemone heart
              <span class="badge badge-primary badge-pill">2</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              なわとび
              <span class="badge badge-primary badge-pill">1</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
              Beat in Angel
            </a>
            <a href="#" class="list-group-item list-group-item-action">
              にこぷり&hearts;女子道
            </a>
            <a href="#" class="list-group-item list-group-item-action disabled">
              硝子の花園
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">音ノ木坂学院</h5>
                <small>3 days ago</small>
              </div>
              <p class="mb-1">通称「音ノ木坂学院」「オトノキ」。高坂穂乃果などが通う、秋葉原、神田、神保町という3つの街のはざまにある伝統校。女子高校であり、現在入学希望者は少なく廃校の検討が発表されている。</p>
              <small>スクールアイドルグループ「μ's」</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">UTX学園</h5>
                <small class="text-muted">3 days ago</small>
              </div>
              <p class="mb-1">秋葉原に在する、周辺地域で一番人気のエスカレーター式の高校。現在も生徒をたくさん集めている。その校舎は秋葉原UDXビルをモデルにしている。</p>
              <small class="text-muted">スクールアイドルグループ「A-RISE」</small>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <h2>Cards</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="card mb-3">
            <div class="card-header">Default card</div>
            <div class="card-body">
              <h4 class="card-title">高坂穂乃果</h4>
              <p class="card-text">『ラブライブ！』の主人公。16歳の高校2年生。一人称は「私」、「穂乃果」。左側の髪の一部を黄色のリボンで結んでいるセミロングヘア。好きな食べ物はいちご、嫌いな食べ物はピーマン。</p>
            </div>
          </div>
          <div class="card text-white bg-primary mb-3">
            <div class="card-header">Primary card</div>
            <div class="card-body">
              <h4 class="card-title">園田海未</h4>
              <p class="card-text">16歳の高校2年生。一人称は「私」。腰まで伸ばした、青みがかかった黒のロングヘア。好きな食べ物は穂乃果の家のまんじゅう、嫌いな食べ物は炭酸飲料。</p>
            </div>
          </div>
          <div class="card text-white bg-secondary mb-3">
            <div class="card-header">Secondary card</div>
            <div class="card-body">
              <h4 class="card-title">南ことり</h4>
              <p class="card-text">16歳の高校2年生。一人称は「私」、「ことり」。ロングヘアを向かって左側の髪の一部の根元を輪にして緑のリボンで結んでいる。好きな食べ物はチーズケーキ、嫌いな食べ物はにんにく。</p>
            </div>
          </div>
          <div class="card text-white bg-success mb-3">
            <div class="card-header">Success card</div>
            <div class="card-body">
              <h4 class="card-title">小泉花陽</h4>
              <p class="card-text">15歳の高校1年生。一人称は「花陽」、「私」。セミショートヘア。好きな食べ物は白いごはん、嫌いな食べ物はなし。</p>
            </div>
          </div>
          <div class="card text-white bg-danger mb-3">
            <div class="card-header">Danger card</div>
            <div class="card-body">
              <h4 class="card-title">西木野真姫</h4>
              <p class="card-text">15歳の高校1年生。一人称は「私」。セミロングヘア。好きな食べ物はトマト、嫌いな食べ物はみかん。</p>
            </div>
          </div>
          <div class="card text-white bg-warning mb-3">
            <div class="card-header">Warning card</div>
            <div class="card-body">
              <h4 class="card-title">星空凛</h4>
              <p class="card-text">15歳の高校1年生。一人称は「凛」。ショートヘア。好きな食べ物はラーメン、嫌いな食べ物はお魚。</p>
            </div>
          </div>
          <div class="card text-white bg-info mb-3">
            <div class="card-header">Info card</div>
            <div class="card-body">
              <h4 class="card-title">絢瀬絵里</h4>
              <p class="card-text">17歳の高校3年生。一人称は「私」、「エリチカ」。ロングヘアをシュシュで結んでポニーテールにしている。好きな食べ物はチョコレート、嫌いな食べ物は梅干とのり。</p>
            </div>
          </div>
          <div class="card bg-light mb-3">
            <div class="card-header">Light card</div>
            <div class="card-body">
              <h4 class="card-title">矢澤にこ</h4>
              <p class="card-text">17歳の高校3年生。一人称は「にこ」、「私」。好きな食べ物はお菓子、嫌いな食べ物は辛いもの。</p>
            </div>
          </div>
          <div class="card text-white bg-dark mb-3">
            <div class="card-header">Dark card</div>
            <div class="card-body">
              <h4 class="card-title">東條希</h4>
              <p class="card-text">17歳の高校3年生。一人称は「ウチ」。ロングヘアを左右に分けてシュシュで結んでいる。好きな食べ物は焼肉、嫌いな食べ物はキャラメル。</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="card mb-3">
            <div class="card-header">Default card</div>
            <div class="card-body">
              <h4 class="card-title">高坂穂乃果</h4>
              <p class="card-text">『ラブライブ！』の主人公。16歳の高校2年生。一人称は「私」、「穂乃果」。左側の髪の一部を黄色のリボンで結んでいるセミロングヘア。好きな食べ物はいちご、嫌いな食べ物はピーマン。</p>
            </div>
          </div>
          <div class="card border-primary mb-3">
            <div class="card-header">Primary card</div>
            <div class="card-body">
              <h4 class="card-title">園田海未</h4>
              <p class="card-text">16歳の高校2年生。一人称は「私」。腰まで伸ばした、青みがかかった黒のロングヘア。好きな食べ物は穂乃果の家のまんじゅう、嫌いな食べ物は炭酸飲料。</p>
            </div>
          </div>
          <div class="card border-secondary mb-3">
            <div class="card-header">Secondary card</div>
            <div class="card-body">
              <h4 class="card-title">南ことり</h4>
              <p class="card-text">16歳の高校2年生。一人称は「私」、「ことり」。ロングヘアを向かって左側の髪の一部の根元を輪にして緑のリボンで結んでいる。好きな食べ物はチーズケーキ、嫌いな食べ物はにんにく。</p>
            </div>
          </div>
          <div class="card border-success mb-3">
            <div class="card-header">Success card</div>
            <div class="card-body">
              <h4 class="card-title">小泉花陽</h4>
              <p class="card-text">15歳の高校1年生。一人称は「花陽」、「私」。セミショートヘア。好きな食べ物は白いごはん、嫌いな食べ物はなし。</p>
            </div>
          </div>
          <div class="card border-danger mb-3">
            <div class="card-header">Danger card</div>
            <div class="card-body">
              <h4 class="card-title">西木野真姫</h4>
              <p class="card-text">15歳の高校1年生。一人称は「私」。セミロングヘア。好きな食べ物はトマト、嫌いな食べ物はみかん。</p>
            </div>
          </div>
          <div class="card border-warning mb-3">
            <div class="card-header">Warning card</div>
            <div class="card-body">
              <h4 class="card-title">星空凛</h4>
              <p class="card-text">15歳の高校1年生。一人称は「凛」。ショートヘア。好きな食べ物はラーメン、嫌いな食べ物はお魚。</p>
            </div>
          </div>
          <div class="card border-info mb-3">
            <div class="card-header">Info card</div>
            <div class="card-body">
              <h4 class="card-title">絢瀬絵里</h4>
              <p class="card-text">17歳の高校3年生。一人称は「私」、「エリチカ」。ロングヘアをシュシュで結んでポニーテールにしている。好きな食べ物はチョコレート、嫌いな食べ物は梅干とのり。</p>
            </div>
          </div>
          <div class="card border-light mb-3">
            <div class="card-header">Light card</div>
            <div class="card-body">
              <h4 class="card-title">矢澤にこ</h4>
              <p class="card-text">17歳の高校3年生。一人称は「にこ」、「私」。好きな食べ物はお菓子、嫌いな食べ物は辛いもの。</p>
            </div>
          </div>
          <div class="card border-dark mb-3">
            <div class="card-header">Dark card</div>
            <div class="card-body">
              <h4 class="card-title">東條希</h4>
              <p class="card-text">17歳の高校3年生。一人称は「ウチ」。ロングヘアを左右に分けてシュシュで結んでいる。好きな食べ物は焼肉、嫌いな食べ物はキャラメル。</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="bs-component">
          <div class="card mb-3">
            <h3 class="card-header">News</h3>
            <div class="card-body">
              <h5 class="card-title">アイドル研究部(μ's)の海外ライブが放映されました</h5>
              <h6 class="card-subtitle text-muted">米・ニューヨーク ブロードウェイにてパフォーマンスを披露</h6>
            </div>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/oWIE7GwJu3c?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
            <div class="card-body">
              <p class="card-text">日本国内で注目されている「スクールアイドル」が米国でも注目され、米国のテレビ番組に前回ラブライブ！優勝チームであるμ’ｓが出演しました。</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Angelic Angel</li>
              <li class="list-group-item">SUNNY DAY SONG</li>
              <li class="list-group-item">僕たちはひとつの光</li>
            </ul>
            <div class="card-body">
              <a href="#" class="card-link">ラブライブ！公式</a>
              <a href="#" class="card-link">音ノ木坂学院</a>
            </div>
            <div class="card-footer text-muted">
              2日前
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">タイトル</h4>
              <h6 class="card-subtitle mb-2 text-muted">サブタイトル</h6>
              <p class="card-text">ここに本文が入ります。カードはヘッダー・フッターがないスタイルもつくることができます。</p>
              <a href="#" class="card-link">リンク1</a>
              <a href="#" class="card-link">リンク2</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- Dialogs
  ================================================== -->
  <section class="co-12 bs-docs-section">

    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="dialogs">Dialogs</h1>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <h2>Modals</h2>
        <div class="bs-component">
          <div class="modal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">タイトル</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p contenteditable>サンプルテキストサンプルテキストサンプルテキスト</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary">変更を保存</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <h2>Popovers</h2>
        <div class="bs-component" style="margin-bottom: 3em;">
          <button type="button" class="btn btn-secondary" title="タイトル" data-container="body" data-toggle="popover" data-placement="left" data-content="本文サンプル本文サンプル本文サンプル">Left</button>

          <button type="button" class="btn btn-secondary" title="タイトル" data-container="body" data-toggle="popover" data-placement="top" data-content="本文サンプル本文サンプル本文サンプル">Top</button>

          <button type="button" class="btn btn-secondary" title="タイトル" data-container="body" data-toggle="popover" data-placement="bottom" data-content="本文サンプル本文サンプル本文サンプル">Bottom</button>

          <button type="button" class="btn btn-secondary" title="タイトル" data-container="body" data-toggle="popover" data-placement="right" data-content="本文サンプル本文サンプル本文サンプル">Right</button>
        </div>
        <h2>Tooltips</h2>
        <div class="bs-component">
          <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="left" title="左方向にでるTooltip">Left</button>

          <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="上方向にでるTooltip">Top</button>

          <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="下方向にでるTooltip">Bottom</button>

          <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="右方向にでるTooltip">Right</button>
        </div>
      </div>
    </div>

  </section>
    <!-- Blockquotes -->

    <div class="row">
      <div class="col-lg-12">
        <h2 id="type-blockquotes">Blockquotes</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <blockquote class="blockquote">
            <p class="mb-0">BootstrapはWebサイトやWebアプリケーションを作成するフリーソフトウェアツール集である。タイポグラフィ、フォーム、ボタン、ナビゲーション、その他構成要素やJavaScript用拡張などがHTML及びCSSベースのデザインテンプレートとして用意されている。</p>
            <footer class="blockquote-footer">出典 <cite title="Bootstrap - Wikipedia">Bootstrap - Wikipedia</cite></footer>
          </blockquote>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <blockquote class="blockquote text-center">
            <p class="mb-0">BootstrapはWebサイトやWebアプリケーションを作成するフリーソフトウェアツール集である。タイポグラフィ、フォーム、ボタン、ナビゲーション、その他構成要素やJavaScript用拡張などがHTML及びCSSベースのデザインテンプレートとして用意されている。</p>
            <footer class="blockquote-footer">出典 <cite title="Bootstrap - Wikipedia">Bootstrap - Wikipedia</cite></footer>
          </blockquote>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <blockquote class="blockquote text-right">
            <p class="mb-0">BootstrapはWebサイトやWebアプリケーションを作成するフリーソフトウェアツール集である。タイポグラフィ、フォーム、ボタン、ナビゲーション、その他構成要素やJavaScript用拡張などがHTML及びCSSベースのデザインテンプレートとして用意されている。</p>
            <footer class="blockquote-footer">出典 <cite title="Bootstrap - Wikipedia">Bootstrap - Wikipedia</cite></footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>
</div>