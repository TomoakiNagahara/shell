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
$repo  = $home . '/repo/';
$repo  = str_replace('//', '/', $repo);

//  Create directory.
foreach( $lists as $key => $list ){
    //  Create target path.
    $path = "{$repo}/op/{$key}/";
    $path = str_replace('//', '/', $path);

    //  ...
    foreach( $list as $name ){
        //  Add extension label.
        $io = CreateGitRepository("{$path}{$name}.git");

        echo $io ? 1:0;
        echo "{$path}{$name}.git\n";
    }
}

/** Create git repository.
 *
 * @param     string     $path
 * @return    boolean    $io
 */
function CreateGitRepository(string $path){
    //    Check if already created.
    if( file_exists("{$path}/HEAD") ){
        return true;
    }

    //  Check if path exists.
    if(!file_exists($path) ){
        //    Make directory.
        mkdir($path, 0755, true);
    }

    //  Change directory.
    if(!chdir($path) ){
        exit("chdir was failed. ($path)");
    }

    //    ...
    echo 'non: '.getcwd()."\n";
    `git init --bare`;

    //    ...
    return file_exists("{$path}/HEAD");
}
