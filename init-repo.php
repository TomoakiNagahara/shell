<?php
//  Init
$lists = [
    'core'    => [
        '5',
        '7',
    ],
    'unit'    => [
        'app',
        'cd',
        'ci',
        'git',
        'router',
        'layout',
        'template',
        'webpack',
    ],
    'layout'  => [
        'white',
        'flexbox',
    ],
    'module'  => [
        'develop',
        'tutorial',
        'reference',
    ],
    'webpack' => [
        'js',
        'css',
    ],
];

//  ...
switch( $os = PHP_OS ){
    case 'Darwin':
        $home = '/Users/';
        break;
    default:
    exit("Undefined OS: $os\n");
}

//  ...
$home .= $_SERVER['USER'].'/';
$repo  = $home . 'repo/';
$git   = $repo . 'temp.git';

//  Check temp repository exists.
if(!file_exists($git) ){
    //  ...
    if(!mkdir($git, 0755, true) ){
        exit("Failed mkdir($repo, 0644, true)\n");
    }
    //  ...
    if(!chdir($git)){
        exit("Failed chdir($git)\n");
    }
    echo getcwd()."\n";
    `git init --bare`;
}

//  Create directory.
foreach( $lists as $key => $list ){
    //  Create target path.
    $path = $repo . "op/$key";

    //  Check path exists.
    if(!file_exists($path) ){
        mkdir($path, 0755, true);
    }

    //  Change home directory.
    if(!chdir($path) ){
        exit("chdir was failed. ($path)");
    }

    //  ...
    foreach( $list as $name ){
        //  Add extention label.
        $name .= '.git';
        //  ...
        if( file_exists($name) ){
            continue;
        }
        //  ...
        copy($repo.'temp.git', './'.$name);
    }

    exit;
}
