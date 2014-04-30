<?php
/**
 * SkinTemplate class for Custard skin
 *
 * @file
 * @ingroup Skins
 */
class SkinCustard extends SkinTemplate {
	var $skinname = 'custard', $stylename = 'custard',
		$template = 'CustardTemplate', $useHeadElement = true;
	/**
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		// Load CSS via ResourceLoader
		$out->addModuleStyles( 'skins.custard' );

		// Load JS via ResourceLoader
		$out->addModules( 'skins.custard' );
	}

}

/**
 * BaseTemplate class for Custard skin
 *
 * @ingroup Skins
 */
class CustardTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$skin = $this->getSkin();
		$ip = $skin->getRequest()->getIP();
		$user = $skin->getUser();
		$title = $skin->getTitle();

		function generateTab( $href, $message, $action ) {
			$getAction = null;

			if ( $action == $getAction ) {
				$class = ' class="selected"';
			} else {
				$class = null;
			}

			echo '<li><a href="' . $href . '"' . $class . '>' . wfMessage( $message )->plain() .
				'</a><span class="invert"></span></li>';
		}

		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();
		$this->html( 'headelement' ); ?>
		<?php
		/* if ( $this->data['username'] == 'ShermanTheMythran'
			|| $this->data['username'] == 'SirComputer'
			|| $this->data['username'] == 'ToaMeiko'
			|| $this->data['username'] == 'NXT'
			|| $this->data['username'] == 'UltrasonicNXT'
			|| $this->data['username'] == 'Root'
		) { //temp whitelisting - until skin is properly functional */ ?>
			<div id="taskbar">
				<div class="toggle">
					<span class="text">≡</span>
					<span class="invert"></span>
				</div>
				<div id="mw-js-message" class="message notice" style="display:none;"></div>
				<?php
			if ( $this->data['sitenotice'] ) { ?>
					<div id="site-notice" class="notice">
						<?php $this->html( 'sitenotice' ); ?>
					</div>
				<?php
			} ?>
				<?php
			if ( $this->data['newtalk'] ) { ?>
				<div id="new-talk" class="message notice">
					<?php $this->html( 'newtalk' ); ?>
				</div>
				<?php
			} ?>
				<div id="actions">
					<div class="user module medium">
						<?php echo $user->getName(); ?>
						<ul class="menu">
							<li><a href="<?php echo $user->getUserPage()->getFullURL(); ?>"><?php echo wfMessage( 'custard-user-page' )->plain() ?></a></li>
							<li><a href="<?php echo $user->getTalkPage()->getFullURL(); ?>"><?php echo wfMessage( 'custard-talk' )->plain() ?></a></li>
							<?php
			if ( $user->isLoggedIn() ) { ?>
							<li><a href="<?php echo Title::newFromText( 'User_blog:' . $user->getTitleKey() )->getFullURL(); ?>"><?php echo wfMessage( 'custard-blog' )->plain() ?></a></li>
							<li><a href="<?php echo SpecialPage::getTitleFor( 'Contributions' )->getFullURL() ?>"><?php echo wfMessage( 'mycontris' )->plain() ?></a></li><?php
			} else { ?>
							<li><a href="<?php echo SpecialPage::getTitleFor( 'Contributions' )->getFullURL() ?>"><?php echo wfMessage( 'mycontris' )->plain() ?></a></li>
							<li><a href="<?php echo SpecialPage::getTitleFor( 'Userlogin' )->getFullURL() ?>"><?php echo wfMessage( 'login' )->plain() ?></a></li>
							<li><a href="<?php echo SpecialPage::getTitleFor( 'Userlogin', 'signup' )->getFullURL() ?>"><?php echo wfMessage( 'custard-sign-up' )->plain() ?></a></li><?php
			}
							?>
						</ul>
					</div>
					<div class="navigation module medium">
						Navigation
						<ul class="menu">
							<?php
								$nav = explode( "\n", wfMessage( 'custard-navigation' )->escaped() );
								$lastUsed = 0;
			for ( $navNum = 0; $navNum <= count( $nav ); $navNum++ ) {
				if ( substr( $nav[$navNum], 0, 1 ) == '*' ) {
					if ( substr( $nav[$navNum], 0, 2 ) == '**' ) {
						if ( substr( $nav[$navNum], 0, 3 ) == '***' ) {
							switch ( $lastUsed ) {
								case 0:
									echo '<li>undefined<ul class="submenu1"><li>undefined<ul class="submenu2">';
									break;
								case 1:
									echo '<ul class="submenu1"><li>undefined<ul class="submenu2">';
									break;
								case 2:
									echo '<ul class="submenu2">';
									break;
								case 3:
									echo '</li>';
									break;
							}
							$itemString = ltrim( $nav[$navNum], '*' );
							if ( !stristr( $itemString, '|' ) ) {
								$itemString .= '|' . $itemString;
							}
							$itemArray = explode( '|', $itemString );
							echo '<li><a href="/wiki/' . str_replace( ' ', '_', $itemArray[0] ) . '">' . $itemArray[1] . '</a>';
							$lastUsed = 3;
						} else {
							switch ( $lastUsed ) {
								case 0:
									echo '<li>undefined<ul class="submenu1">';
									break;
								case 1:
									echo '<ul class="submenu1">';
									break;
								case 2:
									echo '</li>';
									break;
								case 3:
									echo '</li></ul>';
									break;
							}
							$itemString = ltrim( $nav[$navNum], '*' );
							if ( !stristr( $itemString, '|' ) ) {
								$itemString .= '|' . $itemString;
							}
							$itemArray = explode( '|', $itemString );
							echo '<li><a href="/wiki/' . str_replace( ' ', '_', $itemArray[0] ) . '">' . $itemArray[1] . '</a>';
							$lastUsed = 2;
						}
					} else {
						switch ( $lastUsed ) {
							case 0:
								echo '';
								break;
							case 1:
								echo '</li>';
								break;
							case 2:
								echo '</li></ul>';
								break;
							case 3:
								echo '</li></ul></li></ul>';
								break;
						}
						$itemString = ltrim( $nav[$navNum], '*' );
						if ( !stristr( $itemString, '|' ) ) {
							$itemString .= '|' . $itemString;
						}
						$itemArray = explode( '|', $itemString );
						echo '<li><a href="/wiki/' . str_replace( ' ', '_', $itemArray[0] ) . '">' . $itemArray[1] . '</a>';
						$lastUsed = 1;
					}
				}
			}
							?>
						</ul>
					</div>
					<div class="tools module medium">Tools</div>
					<div class="search module medium">
						<div id="search">
							<form action="<?php $this->text( 'wgScript' ) ?>" id="searchform" class="searchform" method="get">
								<input type="hidden" name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
								<?php echo $this->makeSearchInput( array( 'id' => 'searchInput', 'name' => 'search' ) ); ?>
							</form>
						</div>
					</div>
					<div class="level module medium">Level</div>
					<div class="chat module narrow">Chat</div>
					<div class="watch module narrow <?php
			if ( $title->isWatchable() ) {
				if ( $title->userIsWatching( $this->data['title'] ) ) {
					echo 'watching';
				}
			} else {
				echo 'disabled';
			} ?>" title="<?php echo wfMessage( 'watch' )->plain() ?>">
						<a<?php
			if ( $title->isWatchable() ) {
				if ( $title->userIsWatching( $this->data['title'] ) ) {
					echo " href='?action=unwatch'";
				} else {
					echo " href='?action=watch'";
				}
			} ?>>
							<svg class="eye" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
								<!-- Created with SVG-edit - http://svg-edit.googlecode.com/ -->
								<g>
									<path fill="none" stroke="#BBB" stroke-width="2" stroke-dasharray="null" d="m1.55,10c0,-0.00331 3.78149,-4.35 8.45,-4.35c4.66851,0 8.450001,4.34669 8.450001,4.35c0,0.00331 -3.78149,4.35 -8.450001,4.35c-4.66851,0 -8.45,-4.34669 -8.45,-4.35z" id="svg_1"/>
									<circle fill="#BBB" stroke="#3d9ec8" stroke-dasharray="null" cx="10" cy="10" r="2.5" id="svg_2"/>
								</g>
							</svg>
							<!--[if lte IE 8]>
								<?php echo "<object data='$IP/skins/custard/Images/eye.svg' type='image/svg+xml' class='eye'></object>"; ?>
							<![endif]-->
						</a>
					</div>
					<div class="preferences module narrow">
						<a href="<?php echo SpecialPage::getTitleFor( 'Preferences' )->getFullURL() ?>" title="<?php echo wfMessage( 'preferences' )->plain() ?>">
							<svg class="gear" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
								<!-- Created with SVG-edit - http://svg-edit.googlecode.com/ -->
								<g>
									<g id="svg_13">
										<ellipse stroke="#bbbbbb" fill-opacity="0" ry="5" rx="5" id="svg_17" cy="10" cx="10" stroke-width="4" fill="#000000"/>
										<g id="svg_3">
											<circle stroke="#bbbbbb" id="svg_30" r="1" cy="3.5" cx="10" fill-opacity="0" stroke-dasharray="null" stroke-width="2.5" fill="none"/>
											<circle stroke="#bbbbbb" id="svg_32" r="1" cy="10" cx="16.5" fill-opacity="0" stroke-dasharray="null" stroke-width="2.5" fill="none"/>
											<circle stroke="#bbbbbb" id="svg_33" r="1" cy="10" cx="3.5" fill-opacity="0" stroke-dasharray="null" stroke-width="2.5" fill="none"/>
											<circle stroke="#bbbbbb" id="svg_34" r="1" cy="16.5" cx="10" fill-opacity="0" stroke-dasharray="null" stroke-width="2.5" fill="none"/>
										</g>
										<g id="svg_8" transform="rotate(45 10 10)">
											<circle id="svg_9" stroke="#bbbbbb" r="1" cy="3.5" cx="10" fill-opacity="0" stroke-dasharray="null" stroke-width="2.5" fill="none"/>
											<circle id="svg_10" stroke="#bbbbbb" r="1" cy="10" cx="16.5" fill-opacity="0" stroke-dasharray="null" stroke-width="2.5" fill="none"/>
											<circle id="svg_11" stroke="#bbbbbb" r="1" cy="10" cx="3.5" fill-opacity="0" stroke-dasharray="null" stroke-width="2.5" fill="none"/>
											<circle id="svg_12" stroke="#bbbbbb" r="1" cy="16.5" cx="10" fill-opacity="0" stroke-dasharray="null" stroke-width="2.5" fill="none"/>
										</g>
									</g>
								</g>
							</svg>
							<!--[if lte IE 8]>
								<?php echo "<object data='$IP/skins/custard/Images/gear.svg' type='image/svg+xml' class='gear'></object>"; ?>
							<![endif]-->
						</a>
					</div>
				</div>
			</div>

			<div id="interwiki">
				<div class="left">
					<div class="shell">
						<a href="#meta">Meta</a>
						<a href="#pedia">Brickipedia</a>
						<a href="#customs">Customs
							<div><span class="invert"></span></div>
						</a>
					</div>
				</div>
				<div class="mid">
					<a href="#main">Brickimedia</a>
				</div>
				<div class="right">
					<div class="shell">
						<a href="#stories">Stories
							<div><span class="invert"></span></div>
						</a>
						<a href="#cuusoo">Ideas</a>
						<a href="#books">Brickibooks</a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
				
			<div id="page">
				<div id="tabs">
					<ul class="top">
						<?php
							$getAction = $this->data['action'];
							$isEditable = $title->userCan( 'edit' );
							generateTab( '?action=view', 'vector-view-view', 'view' );
							if ( $isEditable ) {
								if ( $user->isAllowed( 'edit' ) ) {
									generateTab( '?action=edit', 'edit', 'edit' );
								} else {
									generateTab( '?action=edit', 'vector-view-viewsource', 'edit' );
								}

								generateTab( '?action=history', 'history_short', 'history' );

								if ( $user->isAllowed( 'move' ) && $title->isMovable() ) {
									generateTab(
										/*
										SpecialPage::getTitleFor( 'Movepage',
											$title->getDBkey() )->getFullURL(),
										*/
										'/wiki/Special:MovePage?title=' .
											str_replace( ' ', '_', $title->getNsText() ) .
											str_replace( ' ', '_', $title->getEscapedText() ),
										'custard-rename'
									);
								}

								if ( $user->isAllowed( 'delete' ) ) {
									generateTab( '?action=delete', 'delete', 'delete' );
								}
							}
						?>
					</ul>
					<ul class="left">
						<?php
						if ( $title->canTalk() == 1 ) {
							generateTab( $title->getTalkPage()->getFullURL(), 'talkpagelinktext' );
						}

						if ( $title->isContentPage() ) {
							generateTab( str_replace( ( 'Talk:' | '_talk' ), '', $title->escapeLocalURL() ), 'nstab-main' );
						} else {
							generateTab( str_replace( '_talk', '', $title->escapeLocalURL() ), $title->getNsText() . ' Page' );
						}
						?>
					</ul>
				</div>
				<h1 id="header">
					<?php $this->html( 'title' ); ?>
				</h1>
				<?php
			if ( $this->data['subtitle'] ) { ?>
					<div class="sub-header">
						<?php $this->html( 'subtitle' ); ?>
					</div>
				<?php 
			}
			if ( $this->data['undelete'] ) { ?>
					<div id="sub-header">
						<?php $this->html( 'undelete' ); ?>
					</div>
					<?php
			} ?>
					<div id="content">
						<?php $this->html( 'bodytext' ) ?>
					</div>
				<?php $this->html( 'catlinks' );
				$this->printTrail(); ?>
			</div>
			<div id="skin-notice" style="display: none;">
				<div class="wrapper">
					<h2>Welcome to Custard Open Beta!</h2>
					<p>Brickimedia's own unique "Custard" skin is now available for public viewing! Plese note that at this early stage, there are many features and functions missing, as well as any bugs. However, as development progresses, please file reports of any bugs you find <a href="https://github.com/Brickimedia/brickimedia/issues/new">in our Github repository</a>, and be sure to add the "custard" label so we can find and fix the issue more quickly. Feedback of any kind is also welcome, and we look forward to setting up Custard as the sleekest, smoothest browsing experience available on Brickimedia!</p>
					<div class="button">Alright, got it!</div>
				</div>
			</div>
		<?php
		/* } else {
			global $IP;
			include_once "$IP/skins/custard/whitelist.php";
		} */ ?>
		</body>
		</html>
		<?php wfRestoreWarnings();
	}
}
