<?php
# Sample LocalSettings.php file to be used with MediaWiki's set up as OD wiki organisations

$wgSitename          = "Sample";
$wgShortName         = "foo";
$wgDBname            = "foo";
$wgDBprefix          = "foo_";
$wgRawHtml           = true;
$wgUseSiteCss        = true;
$wgSecurityUseDBHook = true;

define( 'NS_FORM', 2000 );
$wgExtraNamespaces[NS_FORM]   = 'Form';
$wgExtraNamespaces[NS_FORM+1] = 'Form_talk';

# Don't include extension code if running from shell for maintenance
if ( !$wgCommandLineMode ) {

	# Force HTTPS
	if ( !isset( $_SERVER['HTTPS'] ) ) {
		header( "Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		exit;
	}

	# Redirect main-page requests based on domain
	domainRedirect(array(
		'foo.bar$' => 'About Foo',
		'bar.baz$' => 'About Bar'
	));

	# Example of adding codes for google analytics
	$wgGoogleTrackingCodes[]  = 'UA-1234567-1';

	# General extensions
	include( 'extensions/Nuke/SpecialNuke.php' );
	include( 'extensions/NewUserLog/Newuserlog.php' );
	include( 'extensions/Renameuser/SpecialRenameuser.php' );
	include( 'extensions/UserMerge/UserMerge.php' );	
	include( 'extensions/ParserFunctions/ParserFunctions.php' );
	include( 'extensions/DynamicPageList/DynamicPageList2.php' );
	include( 'extensions/Cite/Cite.php' );

	# OD extensions
	include( 'extensions/InterWiki/InterWiki.php' );
	include( 'extensions/SpecialNukeDPL.php' );
	include( 'extensions/WikidAdmin/SpecialWikidAdmin.php' );
	include( 'extensions/WikiaAdmin/SpecialWikiaAdmin.php' );
	include( 'extensions/EventPipe/EventPipe.php' );
	include( 'extensions/JavaScript/JavaScript.php' );
	include( 'extensions/TransformChanges/TransformChanges.php' );
	include( 'extensions/TreeAndMenu/TreeAndMenu.php' );
	include( 'extensions/RecordAdmin/RecordAdmin.php' );
	include( 'extensions/RecordAdminCreateForm/RecordAdminCreateForm.php' );
	include( 'extensions/RecordAdminIntegratePerson/RecordAdminIntegratePerson.php' );
	include( 'extensions/SimpleSecurity/SimpleSecurity.php' );

	# Lock down to intranet-only
	$wgPageRestrictions['Namespace:Form']['edit'] = 'sysop';
	$wgSecurityExtraGroups                        = array( 'foo', 'bar' );
	$wgSecurityGroupsArticle                      = 'Groups';
	$wgGroupPermissions['*']['read']              = false;
	$wgGroupPermissions['*']['edit']              = false;
	$wgGroupPermissions['*']['createaccount']     = false;
	$wgGroupPermissions['user']['createaccount']  = true;
	$wgWhitelistRead = array( "Special:Userlogin", "-", "MediaWiki:Common.css" );

	# Bot jobs
	include( '/var/www/tools/jobs/ImportCSV.php' );
	include( '/var/www/tools/jobs/ModifyRecords.php' );

	# TreeView style
	$wgTreeViewShowLines = true;
	$wgTreeViewImages['folder']     = "Folder_mist.gif";
	$wgTreeViewImages['folderOpen'] = "Folder_opn_mist.gif";
}


