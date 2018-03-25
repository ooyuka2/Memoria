// quickaccess.js
// 2012/11/21
// 2012/12/19
// 2013/02/23
// 2014/02/22


var file_FullName = changeExt( ScriptFullName, "txt" );
var WshShell = new ActiveXObject( "WScript.Shell" );
var FSO = new ActiveXObject( "Scripting.FileSystemObject" );
var file_Name = FSO.GetFileName( file_FullName );

// �t�@�C�����J���B
// ��Q�����F�I�[�v�����[�h�B
// ��R�����F�t�@�C�������݂��Ȃ������Ƃ��B
// ��S�����F�J���t�@�C���̌`���B
//   TRISTATE_TRUE�FUnicode
//   TRISTATE_FALSE�FASCII
//   TRISTATE_USEDEFAULT�F�V�X�e���f�t�H���g
var openMode = { FORREADING: 1, FORWRITING: 2, FORAPPENDING: 8 };
var create = { YES: true, NO: false }
var format = { TRISTATE_TRUE: -1, TRISTATE_FALSE: 0, TRISTATE_USEDEFAULT: -2 };
var objFile = FSO.OpenTextFile( file_FullName, openMode.FORREADING, create.YES, format.TRISTATE_FALSE );

// ��s���ǂݍ���Ŕz��ɁB
var folderAry = [];
while ( !objFile.AtEndOfStream ){ folderAry.push( objFile.ReadLine() ) }

// �ǂݏI������t�@�C�������B
objFile.Close();

var offset = 10; // �Œ胁�j���[���̏���B
var menu = CreatePopupMenu();
var submenu = CreatePopupMenu();
for ( var i = 0; i < folderAry.length; i++ ){ 
//  ">>"�Ńt�H���_�p�X�ƕ\�����ɕ����B
    var item = folderAry[ i ].split( ">>" );
    menu.Add( item.slice ( -1 ), i + offset, 0 );
}
menu.Add( "-------", 0, meMenuSeparator )
menu.Add( "���̃h�L�������g�̃t�H���_", 1, 0 )
menu.Add( "���[�U�[�t�H���_", 2, 0 )
menu.Add( "-------", 0, meMenuSeparator )
menu.AddPopup( "�ݒ�", submenu );
    submenu.Add( "���̃h�L�������g�̃t�H���_�̒ǉ�", 3, 0 );
    submenu.Add( file_Name + "���J��", 4, 0 );
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
        var input = prompt( "�t�H���_�p�X�i>>�\�����j����͂��Ă��������B", path + ">>" )
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

// �gfilefullname�h���G�f�B�^�ŊJ���Ă���΁gtrue�h�B
function isOpened( filefullname ){ 
    var result = false;
    for ( var i = Editor.Documents.Count-1; i>=0; i-- ){ 
        result = ( result || Editor.Documents.Item( i ).FullName.toUpperCase() == filefullname.toUpperCase() );
        if( result ){ return result };
    }
    return result;
}

// �t�@�C���̃p�X������Ԃ��B
function getPath( file_FullPath ){
    return new ActiveXObject( "Scripting.FileSystemObject" ).GetParentFolderName( file_FullPath );
}

// �g���q�̕ύX
function changeExt( filename, ext ){
   var FSO = new ActiveXObject( "Scripting.FileSystemObject" );
   var path = FSO.GetParentFolderName( filename );
   path += ( path.length > 0 )? "\\" : "" ;
   var bname = FSO.GetBaseName( filename );
   ext = ( typeof( ext ) != "undfined" || ext.length > 0 ) ? "." + ext : "" ;
   return path + bname + ext;
}