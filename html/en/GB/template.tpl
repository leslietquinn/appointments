<!DOCTYPE html> 
<html lang="en">
<head>
	<base target="_self"> 
	<phptag:head />
	
	<link rel="icon" href="data:;base64,iVBORw0KGgo=">
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, shrink-to-fit=no, minimal-ui"> 

	<link rel="canonical" href="//<?php echo $this -> get( '__requesturi' ); ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/format.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/layout.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/common.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/forms.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo $this -> get( '__baseuri' ); ?>css/application.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Special Elite" type="text/css"> 
	<link rel="alternate" hreflang="en-GB" href="<?php echo $this -> get( '__baseuri' ); ?>" />
	
	<!--[if IE]>
		<script src="<?php echo $this -> get( '__baseuri' ); ?>js/html5shiv.js" nonce="<?php echo $this -> get( '__nonce' ); ?>"></script>
	<![endif]--> 
	
	<script nonce="<?php echo $this -> get( '__nonce' ); ?>" src="<?php echo $this -> get( '__baseuri' ); ?>js/jquery-3.6.0.min.js"></script><script nonce="<?php echo $this -> get( '__nonce' ); ?>">

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
	<phptag:body />
</body></html>