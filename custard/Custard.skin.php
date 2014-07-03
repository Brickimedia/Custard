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
	 * Load the skin-specific JavaScript via ResourceLoader.
	 *
	 * @param OutputPage $out
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		$out->addModules( 'skins.custard.js' );
	}

	/**
	 * Load the skin-specific CSS via ResourceLoader.
	 *
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$out->addModuleStyles( 'skins.custard' );
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
		global $wgStylePath;

		$skin = $this->getSkin();
		$user = $skin->getUser();
		$title = $skin->getTitle();

		function generateTab( $href, $message, $action ) {
			$getAction = null;

			if ( $action == $getAction ) {
				$class = ' class="selected"';
			} else {
				$class = null;
			}

			echo '<li><a href="' . $href . '"' . $class . '>' . $skin->msg( $message )->plain() .
				'</a><span class="invert"></span></li>';
		}

		$this->html( 'headelement' ); ?>
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
							<li><a href="<?php echo $user->getUserPage()->getFullURL(); ?>"><?php echo $skin->msg( 'custard-user-page' )->plain() ?></a></li>
							<li><a href="<?php echo $user->getTalkPage()->getFullURL(); ?>"><?php echo $skin->msg( 'custard-talk' )->plain() ?></a></li>
							<?php
			if ( $user->isLoggedIn() ) { ?>
							<li><a href="<?php echo Title::newFromText( 'User_blog:' . $user->getTitleKey() )->getFullURL(); ?>"><?php echo $skin->msg( 'custard-blog' )->plain() ?></a></li>
							<li><a href="<?php echo SpecialPage::getTitleFor( 'Contributions' )->getFullURL() ?>"><?php echo $skin->msg( 'mycontris' )->plain() ?></a></li><?php
			} else { ?>
							<li><a href="<?php echo SpecialPage::getTitleFor( 'Contributions' )->getFullURL() ?>"><?php echo $skin->msg( 'mycontris' )->plain() ?></a></li>
							<li><a href="<?php echo SpecialPage::getTitleFor( 'Userlogin' )->getFullURL() ?>"><?php echo $skin->msg( 'login' )->plain() ?></a></li>
							<li><a href="<?php echo SpecialPage::getTitleFor( 'Userlogin', 'signup' )->getFullURL() ?>"><?php echo $skin->msg( 'custard-sign-up' )->plain() ?></a></li><?php
			}
							?>
						</ul>
					</div>
					<div class="navigation module medium">
						<?php echo $skin->msg( 'custard-navigation-title' )->plain() ?>
						<ul class="menu">
							<?php
								$nav = explode( "\n", $skin->msg( 'custard-navigation' )->escaped() );
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
							if ( isset( $itemArray[0] ) && $itemArray[0] ) {
								echo '<li>' . Linker::link(
									Title::newFromText( $itemArray[0] ),
									( isset( $itemArray[1] ) ? $itemArray[1] : $itemArray[0] )
								) . '</li>';
							}
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
							if ( isset( $itemArray[0] ) && $itemArray[0] ) {
								echo '<li>' . Linker::link(
									Title::newFromText( $itemArray[0] ),
									( isset( $itemArray[1] ) ? $itemArray[1] : $itemArray[0] )
								) . '</li>';
							}
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
						if ( isset( $itemArray[0] ) && $itemArray[0] ) {
							echo '<li>' . Linker::link(
								Title::newFromText( $itemArray[0] ),
								( isset( $itemArray[1] ) ? $itemArray[1] : $itemArray[0] )
							) . '</li>';
						}
						$lastUsed = 1;
					}
				}
			}
							?>
						</ul>
					</div>
					<div class="tools module medium"><?php echo $skin->msg( 'custard-tools' )->plain() ?></div>
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
			} ?>" title="<?php echo $skin->msg( 'watch' )->plain() ?>">
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
								<?php echo "<object data='{$wgStylePath}/custard/Images/eye.svg' type='image/svg+xml' class='eye'></object>"; ?>
							<![endif]-->
						</a>
					</div>
					<div class="preferences module narrow">
						<a href="<?php echo SpecialPage::getTitleFor( 'Preferences' )->getFullURL() ?>" title="<?php echo $skin->msg( 'preferences' )->plain() ?>">
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
								<?php echo "<object data='{$wgStylePath}/custard/Images/gear.svg' type='image/svg+xml' class='gear'></object>"; ?>
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
			<div id="dialog">
				<div class="box">
					<h2><?php echo $skin->msg( 'custard-dialog-header' )->plain() ?></h2>
					<p><?php echo $skin->msg( 'custard-dialog-content' )->text() ?></p>
					<div class="button"><?php echo $skin->msg( 'custard-dialog-button' )->plain() ?></div>
				</div>
			</div>
		</body>
		</html>
		<?php
	}
}
