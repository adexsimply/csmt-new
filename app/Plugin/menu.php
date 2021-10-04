<?php
namespace App\Plugin;

class Menu{


		const menu = [
					'Dashboard |dashboard' => 'home',
					
					'Sessions |anchor' => 'sessions',
					
					'Academic Record |graduation-cap' => 'subjects#assessment',

					'Classes |users' => [
											'Junior classes' => 'classes/1', 
											'Senior Classes'=>'classes/2'
										],

					'Students |user-circle' => [
													'All students'=>'students', 
													'Boarding Students'=>'students/1/1', 
													'Day students'=>'students/1/2', 
													// 'Active students'=>'students/1', 
													// 'JSS3 Graduate'=>'students/2', 
													'SSS3 Graduate'=>'students/3', 
													'Withdrawn students'=>'students/0',
													'Expelled students'=>'students/4', 
													// 'Birthdays'=>'home#birthday', 
													'Parents'=>'parents',
													'Testimonials'=>'testimonials'
												],

					'Subject |book' => [
											'Setups'=>'subjects#Setup', 
											'Junior school'=>'subjects#junior-school', 
											'Senior school'=>'subjects#senior-school', 
											'Assessments'=>'subjects#assessment',
											'External exams' => 'subjects#external'
										],
										

					'Extra |tint' => [
										'Next term begins' => 'extra#nextTerm',
										'House' => 'extra#house',
										'Club' => 'extra#club',
										'Email' => 'email',
										'Clinic' => 'clinic'
									],


					'Bulk SMS |comments' => 'sms',
					// 'Settings |cogs' => [
					// 						'Users'=>'users', 
					// 						'Roles'=>'roles',
					// 						'Permissions'=>'permissions',
					// 					]

				];



		public static function menu(){
			$menu = '';

			foreach (self::menu as $mainMenu => $link) {

				$menuContent = explode('|', $mainMenu);
					$mainMenu = $menuContent[0];
					$fa = $menuContent[1];


				if(is_array($link)){
					$menu.='
						<li class="has-sub-menu">

						<a href="#">
							<div class="icon-w">
								<div class="fa fa-'.$fa.'"></div>
							</div>
							<span>'.$mainMenu.'</span>
						</a>

						<ul class="sub-menu">
						';

						/*Print sub menu*/
						foreach ($link as $subMenu => $url) {
							$menu.='
								<li>
									<a href="'.url($url).'">'.$subMenu.'</a>
								</li>
							';
						}

					$menu.='</ul> </li>';
				}

				else{
					$menu.='
						<li>
							<a href="'.url($link).'">
								<div class="icon-w">
									<div class="fa fa-'.$fa.'"></div>
								</div>
								<span>'.$mainMenu.'</span>
							</a>
						</li>
					';
				}

				}
			return $menu;
		}




		public static function flyout(){
			$menu = '';

			foreach (self::menu as $mainMenu => $link) {

				$menuContent = explode('|', $mainMenu);
					$mainMenu = $menuContent[0];
					$fa = $menuContent[1];


				if(is_array($link)){
					$menu.='
						<li class="has-sub-menu">

						<a href="#">
							<div class="icon-w">
								<div class="fa fa-'.$fa.'"></div>
							</div>
							<span>'.$mainMenu.'</span>
						</a>

						<div class="sub-menu-w">
							<div class="sub-menu-header">'.$mainMenu.'</div>
							<div class="sub-menu-i">
                  				<ul class="sub-menu">
						';

						/*Print sub menu*/
						foreach ($link as $subMenu => $url) {
							$menu.='
								<li>
									<a href="'.url($url).'">'.$subMenu.'</a>
								</li>
							';
						}

					$menu.='</ul></div></div> </li>';
				}

				else{
					$menu.='
						<li>
							<a href="'.url($link).'">
								<div class="icon-w">
									<div class="fa fa-'.$fa.'"></div>
								</div>
								<span>'.$mainMenu.'</span>
							</a>
						</li>
					';
				}

				}
			return $menu;
		}


	}
