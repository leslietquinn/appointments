<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo $this -> get( '__alternatebaseuri' ); ?>">
	
	<phptag:head />
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui"> 

	<meta name="slurp" content="noydir">
	<meta name="robots" content="noodp">
	<meta name="robots" content="noarchive">
	<meta name="googlebot" content="noarchive">
	<meta name="robots" content="noimageindex, nomediaindex">
	
	<meta name="handheldfriendly" content="true">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobileoptimized" content="width">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	
	<link rel="icon" href="data:;base64,iVBORw0KGgo=">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/common.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/layout.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/format.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/forms.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__alternatebaseuri' ); ?>css/administration.css">
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Special+Elite" type="text/css"> 
	
	<!--[if IE]>
		<script src="<?php echo $this -> get( '__baseuri' ); ?>js/html5shiv.js"></script>
	<![endif]--> 
	
	<script src="<?php echo $this -> get( '__baseuri' ); ?>js/jquery-3.6.0.min.js"></script>
	<script>

		$( document ).on( 'click', '.gototop', function( e ) {
			e.preventDefault();
			toAnchor( $( 'a[name="top_of_page"]' ) );
		});
		
		function toAnchor( anchor ) {
			$( "html,body" ).animate({ scrollTop: anchor.offset().top }, 'slow' );
		};
		
		$( document ).ready( function() {
			$( '.tip' ).hover( function() {
				var title = $( this ).attr( 'title' );
				$( this ).data( 'data-tip', title ).removeAttr( 'title' );
				$( '<p class="tooltip"></p>' ).text( title ).appendTo( 'body' ).fadeIn( 'slow' );
			}, function() {
				$( this ).attr( 'title', $( this ).data( 'data-tip' ) );
				$( '.tooltip' ).remove();
			});
		});
		
	</script>
</head><body>
	<div id="page">
		<header>
			<phptag:navigation />
		</header>
		<div class="clear"></div>
		
		<div id="body">
			<phptag:body />
			
			<br>
			<br>
		</div>
		<div class="clear"></div>
		
		<phptag:foot />
	</div>

	<phptag:popup />
</body></html> <!-- v001.1 -->
