<?php
    include_once('tbs_class.php');
    include_once('plugins/tbs_plugin_opentbs.php');

    $TBS = new clsTinyButStrong;
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
    //Parametros
    $user = $_REQUEST['user'];
    $nomcourse = $_REQUEST['nomcourse'];
    $nommaestro = $_REQUEST['nommaestro'];
    $nomalumno = $user;
    $fechaalumno = date('Y-m-d');
    $firmadecano = 'firma.png';
    //Cargando template
    $template = 'Diploma.docx';
    $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
    //Escribir Nuevos campos
    $TBS->MergeField('pro.namecourse', $nomcourse);
    $TBS->MergeField('pro.nomalumno', $nomalumno);
    $TBS->MergeField('pro.nommaestro', $nommaestro);
    $TBS->VarRef['x'] = $firmadecano;

    $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

    $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
    $output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
    if ($save_as==='') {
        $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
        exit();
    } else {
        $TBS->Show(OPENTBS_FILE, $output_file_name);
        exit("File [$output_file_name] has been created.");
    }
?>
