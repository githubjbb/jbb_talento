<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="bmottag">
	<meta name="baseurl" content="<?php echo base_url()?>" />

    <title>JBB-APP</title>
	<link rel="icon" type="image/png" href="<?php echo base_url("images/favicon.ico"); ?>" />
	
    <!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url("assets/bootstrap/vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet">
    <!-- Social Buttons CSS -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/bootstrap-social/bootstrap-social.css"); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/bootstrap/dist/css/sb-admin-2.css"); ?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/datatables-plugins/dataTables.bootstrap.css"); ?>" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/datatables-responsive/dataTables.responsive.css"); ?>" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/morrisjs/morris.css"); ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url("assets/bootstrap/vendor/jquery/jquery.min.js"); ?>"></script>
	<!-- jQuery validate-->
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/general.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/jquery.validate.js"); ?>"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
    <body>
		
		<div id="wrapper">
		
			<?php
			//consultar enlaces de videos
			$ci = &get_instance();
			$ci->load->model("general_model");
			
			$leftMenu = '';
			$topMenu = '';
			$itemsLeftMenu = FALSE;
			$itemsTopMenu = FALSE;

			$userRole = $this->session->role;
			//Left MENU 
			$arrParam = array(
				"idRole" => $userRole,
				"menuType" => 1,
				"menuState" => 1
			);
			$itemsLeftMenu = $this->general_model->get_role_menu($arrParam);

			//Top MENU 
			$arrParam = array(
				"idRole" => $userRole,
				"menuType" => 2,
				"menuState" => 1
			);
			$itemsTopMenu = $this->general_model->get_role_menu($arrParam);		

			if($itemsLeftMenu)
			{
				foreach ($itemsLeftMenu as $item):
							
					if($item['menu_url'] && $item['menu_url'] != '')
					{
						$menuURL = base_url($item['menu_url']);
						
						$leftMenu .= '<li>';
						$leftMenu .= '<a href="' . $menuURL . '"><i class="fa ' . $item['menu_icon'] . ' fa-fw"></i> ' . $item['menu_name'] . '</a>';
						$leftMenu .= '</li>';
						
					}else{
						//enlaces del menu
						$arrParam = array(
							"idRole" => $userRole,
							"idMenu" => $item['fk_id_menu'],
							"linkState" => 1,
							"menuType" => 1
						);
						$links = $this->general_model->get_role_access($arrParam);		

						if($links){							
							$leftMenu .= '<li>';
							$leftMenu .= '<a href="#">';
							$leftMenu .= '<i class="fa ' . $item['menu_icon'] . '"></i> ' . $item['menu_name'] . ' <span class="fa arrow"></span>';
							$leftMenu .= '</a>';
							
							$leftMenu .= '<ul class="nav nav-second-level">';
							
							foreach ($links as $list):
								//System URL
								if($list['link_type'] == 1){
									$linkURL = base_url($list['link_url']);
									
									$leftMenu .= '<li>';
									$leftMenu .= '<a href="' . $linkURL . '" > ' . $list['link_name'] . '</a>';
									$leftMenu .= '</li>';
								//Complete URL
								}elseif($list['link_type'] == 2 || $list['link_type'] == 4 || $list['link_type'] == 5){
									$linkURL = $list['link_url'];
									
									$leftMenu .= '<li>';
									$leftMenu .= '<a href="' . $linkURL . '" target="_blank"> ' . $list['link_name'] . '</a>';
									$leftMenu .= '</li>';
								//Complete DIVIDER
								}else{
									$linkURL = base_url($list['link_url']);
									$leftMenu .= '<li class="divider"></li>';
								}
							endforeach;
							
							$leftMenu .= '</ul>';
							$leftMenu .= '</li>';						
						}
					}
				endforeach;
			}
			
			if($itemsTopMenu)
			{						
				foreach ($itemsTopMenu as $item):
								
					if($item['menu_url'] && $item['menu_url'] != '')
					{
						$menuURL = base_url($item['menu_url']);
						
						$topMenu .= '<li>';
						$topMenu .= '<a href="' . $menuURL . '"><i class="fa ' . $item['menu_icon'] . ' fa-fw"></i> ' . $item['menu_name'] . '</a>';
						$topMenu .= '</li>';
						
					}else{
						//enlaces del menu
						$arrParam = array(
							"idRole" => $userRole,
							"idMenu" => $item['fk_id_menu'],
							"linkState" => 1,
							"menuType" => 2
						);
						$links = $this->general_model->get_role_access($arrParam);		

						if($links){
							$topMenu .= '<li class=dropdown>';
							$topMenu .= '<a class="dropdown-toggle" data-toggle="dropdown" href="#">';
							$topMenu .= '<i class="fa ' . $item['menu_icon'] . '"></i> ' . $item['menu_name'] . ' <i class="fa fa-caret-down"></i>';
							$topMenu .= '</a>';
							
							$topMenu .= '<ul class="dropdown-menu dropdown-messages">';
							
							foreach ($links as $list):
								//System URL
								if($list['link_type'] == 1){
									$linkURL = base_url($list['link_url']);
									
									$topMenu .= '<li>';
									$topMenu .= '<a href="' . $linkURL . '" ><i class="fa ' . $list['link_icon'] . ' fa-fw"></i> ' . $list['link_name'] . '</a>';
									$topMenu .= '</li>';
								//Complete URL
								}elseif($list['link_type'] == 2 || $list['link_type'] == 4 || $list['link_type'] == 5){
									$linkURL = $list['link_url'];
									
									$topMenu .= '<li>';
									$topMenu .= '<a href="' . $linkURL . '" target="_blank"><i class="fa ' . $list['link_icon'] . ' fa-fw"></i> ' . $list['link_name'] . '</a>';
									$topMenu .= '</li>';
								//Complete DIVIDER
								}else{
									$linkURL = base_url($list['link_url']);
									$topMenu .= '<li class="divider"></li>';
								}
							

							endforeach;
							
							$topMenu .= '</ul>';
							$topMenu .= '</li>';						
						}
					}
				endforeach;
			}
			
			$data["leftMenu"] = $leftMenu;
			$data["topMenu"] = $topMenu;
			?>
		
		
			<?php $this->load->view("template/menu", $data); ?>
		
			<!-- Start of content -->
			<?php
			if (isset($view) && ($view != '')) {
				$this->load->view($view);
			}
			?>
			<!-- End of content -->
		</div>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/bootstrap/vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("assets/bootstrap/vendor/metisMenu/metisMenu.min.js"); ?>"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url("assets/bootstrap/vendor/raphael/raphael.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendor/morrisjs/morris.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/data/morris-data.js"); ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("assets/bootstrap/dist/js/sb-admin-2.js"); ?>"></script>
    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url("assets/bootstrap/vendor/datatables/js/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendor/datatables-plugins/dataTables.bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendor/datatables-responsive/dataTables.responsive.js"); ?>"></script>
	
	</body>
</html>