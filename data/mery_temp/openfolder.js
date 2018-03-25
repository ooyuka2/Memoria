// quickaccess.js
// 2012/11/21
// 2012/12/19
// 2013/02/23
// 2014/02/22


var file_FullName = changeExt( ScriptFullName, "txt" );
var WshShell = new ActiveXObject( "WScript.Shell" );
var FSO = new ActiveXObject( "Scripting.FileSystemObject" );
var file_Name = FSO.GetFileName( file_FullName );

// ファイルを開く。
// 第２引数：オープンモード。
// 第３引数：ファイルが存在しなかったとき。
// 第４引数：開くファイルの形式。
//   TRISTATE_TRUE：Unicode
//   TRISTATE_FALSE：ASCII
//   TRISTATE_USEDEFAULT：システムデフォルト
var openMode = { FORREADING: 1, FORWRITING: 2, FORAPPENDING: 8 };
var create = { YES: true, NO: false }
var format = { TRISTATE_TRUE: -1, TRISTATE_FALSE: 0, TRISTATE_USEDEFAULT: -2 };
var objFile = FSO.OpenTextFile( file_FullName, openMode.FORREADING, create.YES, format.TRISTATE_FALSE );

// 一行ずつ読み込んで配列に。
var folderAry = [];
while ( !objFile.AtEndOfStream ){ folderAry.push( objFile.ReadLine() ) }

// 読み終わったファイルを閉じる。
objFile.Close();

var offset = 10; // 固定メニュー数の上限。
var menu = CreatePopupMenu();
var submenu = CreatePopupMenu();
for ( var i = 0; i < folderAry.length; i++ ){ 
//  ">>"でフォルダパスと表示名に分離。
    var item = folderAry[ i ].split( ">>" );
    menu.Add( item.slice ( -1 ), i + offset, 0 );
}
menu.Add( "-------", 0, meMenuSeparator )
menu.Add( "このドキュメントのフォルダ", 1, 0 )
menu.Add( "ユーザーフォルダ", 2, 0 )
menu.Add( "-------", 0, meMenuSeparator )
menu.AddPopup( "設定", submenu );
    submenu.Add( "このドキュメントのフォルダの追加", 3, 0 );
    submenu.Add( file_Name + "を開く", 4, 0 );
var r = menu.Track( mePosMouse );

switch( r ){ 
    case 0: break;
    case 1:
        var d = Editor.FullName.replace( "Mery.exe", "") ;
//      var d = WshShell.SpecialFolders( "Desktop" ).replace( "Desktop","" );
//      var d = new ActiveXObject( "WScript.Shell" ).ExpandEnvironmentStrings( "%USERPROFILE%" );
        d = ( Document.path == "" )? d : Document.path ;
        new ActiveXObject( "shell.application" ).open( d );
        break;
    case 2:
        var folder_user = WshShell.SpecialFolders( "Desktop" ).replace( "Desktop","" );
        new ActiveXObject( "shell.application" ).open( folder_user );
        break;
    case 3:
        path = ( document.path == "" )? getPath( Editor.FullName ): document.path;
        var input = prompt( "フォルダパス（>>表示名）を入力してください。", path + ">>" )
        if ( input != "" ){ 
            var objFile = FSO.OpenTextFile( file_FullName, openMode.FORAPPENDING, create.YES, format.TRISTATE_FALSE );
            objFile.WriteLine( input );
            objFile.close();
         }
        break;
    case 4:
        if ( !isOpened( file_FullName ) ){ 
            Editor.NewFile();
            Editor.Documents.Item( editor.Documents.Count-1 ).Activate();
        }
        Editor.OpenFile( file_FullName );
        break;
    default :
        if ( r >= offset ){
            var folderName = folderAry[ r-offset ].split( ">>" )[ 0 ];
            new ActiveXObject( "shell.application" ).open( folderName );
        }
}

// “filefullname”をエディタで開いていれば“true”。
function isOpened( filefullname ){ 
    var result = false;
    for ( var i = Editor.Documents.Count-1; i>=0; i-- ){ 
        result = ( result || Editor.Documents.Item( i ).FullName.toUpperCase() == filefullname.toUpperCase() );
        if( result ){ return result };
    }
    return result;
}

// ファイルのパス部分を返す。
function getPath( file_FullPath ){
    return new ActiveXObject( "Scripting.FileSystemObject" ).GetParentFolderName( file_FullPath );
}

// 拡張子の変更
function changeExt( filename, ext ){
   var FSO = new ActiveXObject( "Scripting.FileSystemObject" );
   var path = FSO.GetParentFolderName( filename );
   path += ( path.length > 0 )? "\\" : "" ;
   var bname = FSO.GetBaseName( filename );
   ext = ( typeof( ext ) != "undfined" || ext.length > 0 ) ? "." + ext : "" ;
   return path + bname + ext;
}