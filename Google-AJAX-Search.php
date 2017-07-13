<?php
/*
Plugin Name: Google Ajax Search
Plugin URI: http://dancameron.org/wordpress
Description: Adds a Google AJAX Search box on your site. Example found <a href="http://dancameron.org">here</a>. Options include searching your site through Google Blog Search and/or straight up Google, a second search option is available that is perfect for flickr. Widgetized for your pleasure. MAKE SURE TO <a href="options-general.php?page=Google-AJAX-Search.php">CONFIGURE</a> your options and enter your API key.
Author: http://dancameron.org
Version: 1.2
Stable tag: 1.2
Author URI: http://dancameron.org

Installation:
	1. Download the plugin and unzip it (didn't you already do this?).
	2. Put the 'googleajaxsearch.php' file into your wp-content/plugins/ directory.
	3. Go to the Plugins page in your WordPress Administration area and click 'Activate' next to Google Ajax Search.
	4. Go to Options > Google Ajax Search to configure your settings and click 'save'.
		a. You will need an API key first. http://code.google.com/apis/ajaxsearch/signup.html
		b. Next you will need to enter CLOSED or OPEN for the displayed search results.
		c. All other options are optional. 
	5. Place the search box where you want by placing <?php gajaxsearch(); ?> into your theme (most likely your sidebar) or simplify your life and use widget sidebars. 
	6. Have fun and if you can contribute (see notes).
		

Notes:
	- If you know how to modify this plugin so you don't have to modify the templates body tag contact me @ dancameron@gmail.com
	

Version history:
- 1.003
Major Theme Fix
	props to http://mr-foto.net/

- 1.003
Firefox flow


- 1.002
URI Fixes
CSS Fix

- 1
Flexible Search Options for multiple search
Title Size Style
Open or Closed Results
Branding/Logo optional
Cleaning
No JS enabled compatibility (thanks JB http://freepressblog.org)

- .995
More Styling Options

- .991
full urls in style sheet

- .99
Seperate Style Sheet

- .95
Cleaned up Admin page

- .9
Added custom width functionality
Corrected style sheet

- .6
Added onload within the plugin, no manual editing.

- .5
Initial Release (Widgetized)

- .25
My First Save
*/

/*
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/



function googleajaxsearch_header() {

	$googleajaxsearch_googleAjaxSearchKey   = get_option("googleajaxsearch_googleAjaxSearchKey");
	$googleajaxsearch_googlewidth   = get_option("googleajaxsearch_googlewidth");
	$googleajaxsearch_googletitlestyle   = get_option("googleajaxsearch_googletitlestyle");
	$googleajaxsearch_googletitlestyle   = get_option("googleajaxsearch_googletitlesize");
	$googleajaxsearch_googlemorestyle   = get_option("googleajaxsearch_googlemorestyle");
	$googleajaxsearch_googleurlstyle   = get_option("googleajaxsearch_googleurlstyle");
	$googleajaxsearch_googleURL2   = get_option("googleajaxsearch_googleURL2");
	$googleajaxsearch_googleURL2desc   = get_option("googleajaxsearch_googleURL2desc");
	$googleajaxsearch_googleAjaxBranding   = get_option("googleajaxsearch_googleAjaxBranding");
	$googleajaxsearch_googleAjaxBSOption   = get_option("googleajaxsearch_googleAjaxBSOption");
	$googleajaxsearch_googleAjax2Option   = get_option("googleajaxsearch_googleAjax2Option");
	$googleajaxsearch_googleAjaxopenoption   = get_option("googleajaxsearch_googleAjaxopenoption");
	$url = get_option("home");

	?>

	<!-- Google Ajax Search -->

	
	<link href="http://www.google.com/uds/css/gsearch.css" type="text/css" rel="stylesheet"/>
	<style>	
	
	/* Width */
	.gsc-control {
	  	width: <?php echo get_option('googleajaxsearch_googlewidth'); ?>px;
		overflow: hidden
	}
	.gs-result .gs-title,
	.gs-result .gs-title * {
		font-size: <?php echo get_option('googleajaxsearch_googletitlesize'); ?>em;
	  	color: #<?php echo get_option('googleajaxsearch_googletitlestyle'); ?>;
	}
	.gsc-results .gsc-trailing-more-results,
	.gsc-results .gsc-trailing-more-results * {
	  	color: #<?php echo get_option('googleajaxsearch_googlemorestyle'); ?>;
	}
	.gs-result a.gs-visibleUrl,
	.gs-result .gs-visibleUrl {
	  	color: #<?php echo get_option('googleajaxsearch_googleurlstyle'); ?>;
	}
	.gs-result a.gs-clusterUrl,
	.gs-result .gs-clusterUrl {
	  	color: #<?php echo get_option('googleajaxsearch_googleurlstyle'); ?>;
	}
	.gsc-resultsbox-visible {
		display: table;
		width: 100%;
		overflow: hidden
	}
	</style>


<?php if( get_option('googleajaxsearch_googleAjaxBranding') == 'true') { ?>
	<style>
	img.gsc-branding-img {
	display: none;
	}
	td.gsc-branding-text div.gsc-branding-text {
	display: none;
	}	
	</style>
<?php } ?>

		
	<script src='http://www.google.com/uds/api?file=uds.js&amp;v=1.0&key=<?php echo get_option('googleajaxsearch_googleAjaxSearchKey'); ?>' type='text/javascript'></script>
	<!-- Google AjaxSearch Plugin for WordPress initialization -->
	<script type='text/javascript'> 




		function OnLoad()
		{
			
			var searchControl = new GSearchControl();
			searchControl .setLinkTarget(GSearch.LINK_TARGET_SELF); 
			var webSearch = new GwebSearch();   
			webSearch.setSiteRestriction("<?php echo get_option('home'); ?>");
			webSearch.setUserDefinedLabel("Results");
			webSearch.setUserDefinedClassSuffix("webSearch");
				<?php if( get_option('googleajaxsearch_googleAjaxBSOption') == 'true') { ?>
			var blogSearch = new GblogSearch(); 
			blogSearch.setSiteRestriction("<?php echo get_option('home'); ?>");
			blogSearch.setUserDefinedLabel("Blog Search");
			blogSearch.setUserDefinedClassSuffix("siteSearch");
			blogSearch.setResultOrder(GSearch.ORDER_BY_DATE);
				<?php } ?>
				<?php if( get_option('googleajaxsearch_googleAjax2Option') == 'true') { ?>
			var secondSearch = new GwebSearch();   
			secondSearch.setSiteRestriction("<?php echo get_option('googleajaxsearch_googleURL2'); ?>");
			secondSearch.setUserDefinedLabel("<?php echo get_option('googleajaxsearch_googleURL2desc'); ?>");
			secondSearch.setUserDefinedClassSuffix("secondSearch");
				<?php } ?>
			var options = new GsearcherOptions();
			options.setExpandMode(GSearchControl.EXPAND_MODE_<?php echo get_option('googleajaxsearch_googleAjaxopenoption'); ?>);
			searchControl.addSearcher(webSearch, options);
				<?php if( get_option('googleajaxsearch_googleAjaxBSOption') == 'true') { ?>
			searchControl.addSearcher(blogSearch, options);
				<?php } ?>
				<?php if( get_option('googleajaxsearch_googleAjax2Option') == 'true') { ?>
			searchControl.addSearcher(secondSearch, options);
				<?php } ?>
			

			var drawOptions = new GdrawOptions();
			drawOptions.setDrawMode(GSearchControl.DRAW_MODE_LINEAR);
			searchControl.draw(document.getElementById("searchcontrol"),drawOptions);
		}
		GSearch.setOnLoadCallback(OnLoad);

	</script>
	<!-- Google Maps Plugin for WordPress (end) -->

<?php } // end googleajaxsearch_header()

//admin panel
function googleajaxsearch_adminPanel() {
		add_options_page('Google Ajax Search', 'Google Ajax Search', 10,
			basename(__FILE__), 'googleajaxsearch_optionsSubpanel');
}
function googleajaxsearch_optionsSubpanel() {
	if($_POST['action'] == "save") {
		echo "<div class=\"updated fade\" id=\"limitcatsupdatenotice\"><p>" . __("Configuration <strong>updated</strong>.") . "</p></div>";
		//updating stuff..
		update_option("googleajaxsearch_googleAjaxSearchKey", $_POST["key"]);
		update_option("googleajaxsearch_googlewidth", $_POST["width"]);
		update_option("googleajaxsearch_googletitlestyle", $_POST["titlestyle"]);
		update_option("googleajaxsearch_googletitlesize", $_POST["titlesize"]);
		update_option("googleajaxsearch_googlemorestyle", $_POST["morestyle"]);
		update_option("googleajaxsearch_googleurlstyle", $_POST["urlstyle"]);
		update_option("googleajaxsearch_googleURL2", $_POST["url2"]);
		update_option("googleajaxsearch_googleURL2desc", $_POST["url2desc"]);
    	update_option("googleajaxsearch_googleAjaxBranding", $_POST["branding"]);
		update_option("googleajaxsearch_googleAjaxBSOption", $_POST["BSOption"]);
		update_option("googleajaxsearch_googleAjax2Option", $_POST["2Option"]);
		update_option("googleajaxsearch_googleAjaxopenoption", $_POST["open"]);

		
				
		$googleajaxsearch_googleAjaxSearchKey   = get_option("googleajaxsearch_googleAjaxSearchKey");
		$googleajaxsearch_googleURL2   = get_option("googleajaxsearch_googleURL2");
		$googleajaxsearch_googleURL2desc   = get_option("googleajaxsearch_googleURL2desc");
		$googleajaxsearch_googlewidth   = get_option("googleajaxsearch_googlewidth");
		$googleajaxsearch_googletitlestyle   = get_option("googleajaxsearch_googletitlestyle");
		$googleajaxsearch_googletitlestyle   = get_option("googleajaxsearch_googletitlesize");
		$googleajaxsearch_googlemorestyle   = get_option("googleajaxsearch_googlemorestyle");
		$googleajaxsearch_googleurlstyle   = get_option("googleajaxsearch_googleurlstyle");
		$googleajaxsearch_googleAjaxBranding   = get_option("googleajaxsearch_googleAjaxBranding");
		$googleajaxsearch_googleAjaxBSOption   = get_option("googleajaxsearch_googleAjaxBSOption");
		$googleajaxsearch_googleAjax2Option   = get_option("googleajaxsearch_googleAjax2Option");
		$googleajaxsearch_googleAjaxopenoption  = get_option("googleajaxsearch_googleAjaxopenoption");

	     }

		?>
		
		<div class="wrap">
		<h2>Google AJAX Search</h2>	
		<form method="post">
	    <fieldset class="options">
		<legend>Configuration</legend>
		<table class="optiontable">
			
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXKey"><strong>REQUIRED:</strong><br/>API Key</label>
		</th>
		<td>
			
		<input type="text" name="key" size="90" value='<?php echo get_option('googleajaxsearch_googleAjaxSearchKey'); ?>'>
		<br/>
		Get a Google AJAX Search API key <a href="http://code.google.com/apis/ajaxsearch/signup.html" target="_blank">here</a>.
		</td>
		</tr>
		
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXopen"><strong>REQUIRED:</strong><br/>Open or Closed Results</label>
		</th>
		<td><br/>
		<input type="text" name="open" size="7" value="<?php echo get_option('googleajaxsearch_googleAjaxopenoption'); ?>"><br/>Type 'OPEN' or 'CLOSED' (without quotes)<br/>This makes your search results have an expanded view (open) or a closed view.
		</td>
		</tr>		
		
		</table>
		</fieldset>

		<fieldset class="options">
		<legend>Multiple Search Option</legend>
		<table class="optiontable">
		
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXbranding">Add Blog Search</label>
		</th>
		<td>
		<input name="BSOption" type="checkbox" id="BSOption" value="true"  <?php if(get_option('googleajaxsearch_googleAjaxBSOption') == 'true') { echo 'checked="true"'; } ?> />
		<br/>
		</td>
		</tr>
			
			
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXbranding">Add Second Search</label>
		</th>
		<td>
		<input name="2Option" type="checkbox" id="2Option" value="true"  <?php if(get_option('googleajaxsearch_googleAjax2Option') == 'true') { echo 'checked="true"'; } ?> />
		<br/>
		</td>
		</tr>
		
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXdesc">Second Search Label</label>
		</th>
		<td>
		<input type="text" name="url2desc" size="10" value="<?php echo get_option('googleajaxsearch_googleURL2desc'); ?>"><br>(example: Photostream )
		<br/>
		</td>
		</tr>

		<tr valign="top">
		<th scope="row">
		<label for="gAJAXurl">Second Search URI</label>
		</th>
		<td>
		<input type="text" name="url2" size="30" value="<?php echo get_option('googleajaxsearch_googleURL2'); ?>"><br> (flickr example: flickr.com/photos/camerons )<br/>
		</td>
		</tr>


		
		</table>
	    </fieldset>

		<fieldset class="options">
		<legend>Style Configuration</legend>
		<table class="optiontable">
		
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXbranding">Remove Google Branding/Logo</label>
		</th>
		<td>
		<input name="branding" type="checkbox" id="branding" value="true"  <?php if(get_option('googleajaxsearch_googleAjaxBranding') == 'true') { echo 'checked="true"'; } ?> />
		<br/>
		</td>
		</tr>
				
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXwidth">Search Box Width</label>
		</th>
		<td>
		<input type="text" name="width" size="3" value="<?php echo get_option('googleajaxsearch_googlewidth'); ?>">px<br> (default: 300 )
			<br/>
		</td>
		</tr>

			
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXwidth">Title Link Color</label>
		</th>
		<td>		
		#<input type="text" name="titlestyle" size="6" value="<?php echo get_option('googleajaxsearch_googletitlestyle'); ?>"><br> (default: #0000cc)
		</td>
		</tr>
		
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXwidth">Title Link Size</label>
		</th>
		<td>		
		<input type="text" name="titlesize" size="4" value="<?php echo get_option('googleajaxsearch_googletitlesize'); ?>"><br> (default: 1em)
		</td>
		</tr>
	
	
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXtitle">More Link Color</label>
		</th>
		<td>		
		#<input type="text" name="morestyle" size="6" value="<?php echo get_option('googleajaxsearch_googlemorestyle'); ?>"><br> (default: #0000cc)
		</td>
		</tr>
		
		<tr valign="top">
		<th scope="row">
		<label for="gAJAXwidth">URL Link Color</label>
		</th>
		<td>		
		#<input type="text" name="urlstyle" size="6" value="<?php echo get_option('googleajaxsearch_googleurlstyle'); ?>"><br> (default: #008000)		
			<br/>
		</td>
		</tr>


		
		
		
		</table>
	    </fieldset>

		<fieldset class="options">
		<div class="submit">
		<input type="hidden" name="action" value="save">
		<input type="submit" value="Save">
		</div>
		</fieldset>
		</form>
		<br><br>
	
	</div>
		<?php } // end googleajaxsearch_optionsSubpanel()

function widget_gajaxsearch_init() {

	// Check for the required plugin functions. This will prevent fatal
	// errors occurring when you deactivate the dynamic-sidebar plugin.
	if ( !function_exists('register_sidebar_widget') )
		return;

	// This is the function that outputs our little Google search form.
	function widget_gajaxsearch($args) {
		
		// $args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys. Default tags: li and h2.
		extract($args);

		// Each widget can store its own options. We keep strings here.
		$options = get_option('widget_gajaxsearch');
		$title = $options['title'];


		// These lines generate our output. Widgets can be very complex
		// but as you can see here, they can also be very, very simple.
		echo $before_widget . $before_title . $title . $after_title;
        ?>
                <div id="searchcontrol" width="100%">
                    <form method="get" action="http://blogsearch.google.com/blogsearch ">
                    <input name="as_q" size="16" maxlength="255" value="" type="text">
                    <input name="sa" value="Search" type="submit">
                    <input name="bl_url" value="<?php echo get_option('home'); ?>" type="hidden">
                    </form>
                </div>
        <?php
        echo $after_widget;}  // end widget_gajaxsearch($args)
			

	

	// This is the function that outputs the form to let the users edit
	// the widget's title. It's an optional feature that users cry for.
	function widget_gajaxsearch_control() {

		// Get our options and see if we're handling a form submission.
		$options = get_option('widget_gajaxsearch');
		if ( !is_array($options) )
			$options = array('title'=>'', 'buttontext'=>__('Google AJAX Search', 'widgets'));
		if ( $_POST['gajaxsearch-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['gajaxsearch-title']));
			update_option('widget_gajaxsearch', $options);
			$buttontext = htmlspecialchars($options['buttontext'], ENT_QUOTES);
		}

		// Be sure you format your options to be valid HTML attributes.
	
		
			// Here is our little form segment. Notice that we don't need a
			// complete form. This will be embedded into the existing form.
			echo '<p style="text-align:right;"><label for="gajaxsearch-title">' . __('Title:') . ' <input style="width: 200px;" id="gajaxsearch-title" name="gajaxsearch-title" type="text" value="'.$title.'" /></label></p>';
			
			echo '<input type="hidden" id="gajaxsearch-submit" name="gajaxsearch-submit" value="1" />';
	}
	
	// This registers our widget so it appears with the other available
	// widgets and can be dragged and dropped into any active sidebars.
	register_sidebar_widget(array('Google AJAX Search', 'widgets'), 'widget_gajaxsearch');

	// This registers our optional widget control form. Because of this
	// our widget will have a button that reveals a 300x100 pixel form.
	register_widget_control(array('Google AJAX Search', 'widgets'), 'widget_gajaxsearch_control', 300, 100);
}

// For the few without widgets
function gajaxsearch() {
	?>
			<div id="searchcontrol">
				<form method="get" action="http://blogsearch.google.com/blogsearch">
				<input name="as_q" size="16" maxlength="255" value="" type="text">
				<input name="sa" value="Search" type="submit">
				<input name="bl_url" value="<?php echo get_option('home'); ?>" type="hidden">
				</form>
			</div>
	<?php }  // end gajaxsearch()

// Run our code later in case this loads prior to any required plugins.
add_action('plugins_loaded', 'widget_gajaxsearch_init');

//user hooks
add_action('wp_head', 'googleajaxsearch_header');


//admin hooks
add_action('admin_menu', 'googleajaxsearch_adminPanel');

?>
