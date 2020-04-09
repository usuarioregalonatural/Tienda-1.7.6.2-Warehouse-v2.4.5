<?php
if( !defined( 'ABSPATH') ) exit();
$obj_library = new RevSliderObjectLibrary();

$startanims = $operations->getArrAnimations();
?>
<script>
     var RsTypeWriter = {};
     var RsTypeWriterSliderType = {};
</script>
<?php
$slider_addons = apply_filters('revslider_slide_addons', array(), $slide, $slider);

//var_dump($slider_addons);die('no way');
$global_settings = $operations->getGeneralSettingsValues();
//show/hide layers of specific slides
$add_static = 'false';
if($slide->isStaticSlide()){
	$add_static = 'true';
}
?>



<div style="width:100%;height:20px"></div>
<div class="editor_buttons_wrapper  postbox unite-postbox" style="max-width:100% !important; min-width:1200px !important">

	<div id="nls-wrapper">
		<div class="box-closed tp-accordion" style="border-bottom:5px solid #ddd;">
			<ul class="rs-layer-settings-tabs">
				<li id="rs-style-tab-button" data-content="#rs-style-content-wrapper" class="selected"><i style="height:45px" class="rs-mini-layer-icon rs-icon-droplet rs-toolbar-icon"></i>
					<span class="rs-anim-tab-txt"><?php echo "Style"; ?></span>
					<span id="style-morestyle" class="tipsy_enabled_top" title="<?php echo "Advanced Style on/off"; ?>">
						<span class="rs-icon-morestyles-dark"><i class="eg-icon-down-open"></i></span>
						<span class="rs-icon-morestyles-light"><i class="eg-icon-down-open"></i></span>
					</span>				
				</li>
				<li id="rs-animation-tab-button" data-content="#rs-animation-content-wrapper"><i style="height:45px" class="rs-mini-layer-icon rs-icon-chooser-2 rs-toolbar-icon"></i>
					<span class="rs-anim-tab-txt"><?php echo "Animation"; ?></span>
					<span id="layeranimation-playpause" class=" tipsy_enabled_top" title="<?php echo "Play/Pause Single Layer Animation"; ?>">
						<i class="eg-icon-play"></i>
						<i class="eg-icon-pause"></i>
					</span>
				</li>
				<li id="rs-loopanimation-tab-button" data-content="#rs-loop-content-wrapper"><i style="height:45px" class="rs-mini-layer-icon rs-icon-chooser-3 rs-toolbar-icon"></i>
					<span class="rs-anim-tab-txt"><?php echo "Loop"; ?></span>
					<span id="loopanimation-playpause" class="tipsy_enabled_top" title="<?php echo "Play/Pause Layer Loop Animation"; ?>">
						<i class="eg-icon-play"></i>
						<i class="eg-icon-pause"></i>
					</span>
				</li>
				<li id="v_layers_mp_4" data-content="#rs-visibility-content-wrapper"><i style="height:45px" class="rs-mini-layer-icon rs-icon-visibility rs-toolbar-icon"></i><?php echo "Visibility"; ?></li>
				<li id="v_layers_mp_5" data-content="#rs-behavior-content-wrapper"><i style="height:45px" class="rs-mini-layer-icon eg-icon-resize-full-2 rs-toolbar-icon "></i><?php echo "Behavior"; ?></li>
				<li id="v_layers_mp_6" data-content="#rs-action-content-wrapper"><i style="height:45px; font-size:16px" class="rs-mini-layer-icon eg-icon-link rs-toolbar-icon"></i><?php echo "Actions"; ?></li>
				
				<li id="v_layers_mp_7" data-content="#rs-attribute-content-wrapper"><i style="height:45px" class="rs-mini-layer-icon rs-icon-edit-basic rs-toolbar-icon"></i><?php echo "Attributes"; ?></li>
				<?php if($slide->isStaticSlide()){ ?>
				<li id="v_layers_mp_8" data-content="#rs-static-content-wrapper"><i style="height:45px" class="rs-mini-layer-icon eg-icon-dribbble-1 rs-toolbar-icon"></i><?php echo "Static Layers"; ?></li>
				<?php } ?>
				<li id="v_layers_mp_9" data-content="#rs-parallax-content-wrapper"><i style="height:45px; font-size:16px;" class="rs-mini-layer-icon eg-icon-picture-1 rs-toolbar-icon"></i><?php echo "Parallax / 3D"; ?></li>			
				<?php if(!empty($slider_addons)){ ?>
				<li id="v_layers_mp_10" class="rs-addon-tab-button" data-content="#rs-addon-wrapper"><i style="height:45px; font-size:16px;" class="rs-mini-layer-icon eg-icon-plus-circled rs-toolbar-icon"></i><?php echo "Add-ons"; ?></li>
				<?php } ?>
			</ul>
			<?php
			$sticky_layer = get_option('revslider_slide_editor_sticky', 'false');
			?>
			<span id="sticky_layersettings_toggle"<?php echo ($sticky_layer == 'true') ? ' class="selected"' : ''; ?>><i style="height:45px; font-size:16px;line-height:45px" class="fa-icon-paperclip"></i></span>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
		
		<div id="css_slider_editor_wrap" class="ho_row_ ho_column_ ho_group_" title="<?php echo "Slider Custom CSS/JS Editor" ?>" style="display:none;">
			<div id="show_global_styles" class="show_global_styles revblue button-primary"><?php echo 'Edit Depricated Global Styles'; ?></div>
			<span class="cbi-title"><?php echo "Slider CSS:"?></span>
			<div class="css_editor_novice_wrap">
				<textarea id="textarea_show_slider_styles" rows="20" style="width:100%"></textarea>
			</div>
			<span class="cbi-title"><?php echo "Slider JavaScript:"?></span>
			<div class="css_editor_novice_wrap">
				<textarea id="textarea_show_slider_javascript" rows="20" style="width:100%"></textarea>
			</div>
		</div>
		
		<!-- THE AMAZING TOOLBAR ABOVE THE SLIDE EDITOR -->
		<form id="tp_rs_a_form" name="form_layers" class="form_layers notselected">

			<!-- LAYER STYLING -->
			<div class="layer-settings-toolbar " id="rs-style-content-wrapper" style="">
				<?php //add global styles editor ?>
				<div id="css_static_editor_wrap" class="ho_row_ ho_column_ ho_group_" title="<?php echo "Global Style Editor (Depricated)" ?>" style="display:none;">
					<div id="css-static-accordion">						
						<textarea id="textarea_edit_static" rows="20" style="width:100%"></textarea>
					</div>
				</div>
				<div id="dialog-change-css-static" title="<?php echo "Save Static Styles" ?>" style="display:none;">
					<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 50px 0;"></span><?php echo 'Overwrite current static styles?'?></p>
				</div>
				
				<div>

					<!-- FONT TEMPLATE -->
					<span class="rs-layer-toolbar-box ho_row_ ho_column_ ho_group_" style="padding-right:19px;">
						<i class="rtlmr0 rs-mini-layer-icon rs-icon-fonttemplate rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Caption Style"; ?>" style="margin-right:10px"></i>
						<input type="text"  style="width:150px; padding-right:30px;" class="textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Style Template"; ?>"  id="layer_caption" name="layer_caption" value="-" />
						<span id="layer_captions_down" ><i class="eg-icon-arrow-combo"></i></span>
						<!--<a href="javascript:void(0)" id='button_edit_css' class='revnewgray layer-toolbar-button  tipsy_enabled_top' title="<?php echo "More Style Settings"; ?>"><i class="revicon-cog"></i></a>-->
						<!--<a href="javascript:void(0)" id='button_css_reset' class='revnewgray layer-toolbar-button tipsy_enabled_top' title="<?php echo "Reset Style Template"; ?>"><i class="revicon-ccw"></i></a>-->

						<span id="css-template-handling-dd" class="clicktoshowmoresub" style='margin-left: 4px !important;'>
							<span id="css-template-handling-dd-inner" class="clicktoshowmoresub_inner">
								<span style="background:#ddd !important; padding-left:20px;margin-bottom:5px" class="css-template-handling-menupoint"><span><?php echo "Style Options"; ?></span></span>
								<span id="save-current-css"   class="save-current-css css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-save-dark"></i><span><?php echo "Save"; ?></span></span>
								<span id="save-as-current-css"   class="save-as-current-css css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-save-dark"></i><span><?php echo "Save As"; ?></span></span>
								<span id="rename-current-css" class="rename-current-css css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-chooser-1"></i><span><?php echo "Rename"; ?></span></span>
								<span id="reset-current-css"  class="reset-current-css css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-2drotation"></i><span><?php echo "Reset"; ?></span></span>
								<span id="delete-current-css" class="delete-current-css css-template-handling-menupoint"><i style="background-size:10px 14px;" class="rs-mini-layer-icon rs-toolbar-icon rs-icon-delete"></i><span><?php echo "Delete"; ?></span></span>
							</span>
						</span>
					</span>



					
					<span class="rs-layer-toolbar-box ho_shape_ ho_video_ ho_image_ ho_row_ ho_column_ ho_group_">
						<!-- FONT SIZE -->
						<i class="rs-mini-layer-icon rs-icon-fontsize rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Font Size (px)"; ?>" style="margin-right:6px" ></i>
						<input type="text"  data-suffix="px" class="rs-layer-input-field tipsy_enabled_top" title="<?php echo "Font Size"; ?>" style="width:61px" id="layer_font_size_s" name="font_size_static" value="20px" />
						<span class="rs-layer-toolbar-space"></span>


						<!-- LINE HEIGHT -->
						<i class="rs-mini-layer-icon rs-icon-lineheight rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Line Height (px)"; ?>" style="margin-right:11px" ></i>
						<input type="text" data-suffix="px" class="rs-layer-input-field tipsy_enabled_top" title="<?php echo "Line Height"; ?>" style="width:61px" id="layer_line_height_s" name="line_height_static" value="22px" />
						<span class="rs-layer-toolbar-space" style="margin-right:10px" ></span>
                                                <!-- COLOR -->
						<i class="rs-mini-layer-icon rs-icon-color rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Font Color",'revslider'); ?>"></i>
						<input type="text" class="my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("Font Color",'revslider'); ?>"  data-editing="Layer Color" data-mode="single" id="layer_color_s" name="color_static" value="#ffffff" />

                                        </span>


					<!-- WRAP -->
					<span class="rs-layer-toolbar-box tipsy_enabled_top ho_row_ ho_column_ ho_group_" style="display: none" title="<?php echo "White Space"; ?>">
						<i class="rs-mini-layer-icon rs-icon-wrap rs-toolbar-icon"></i>
						<select class="rs-layer-input-field" style="width:95px" id="layer_whitespace" name="layer_whitespace">
							<option value="normal"><?php echo 'Normal'; ?></option>
							<option value="pre"><?php echo 'Pre'; ?></option>
							<option value="nowrap" selected="selected"><?php echo 'No-wrap'; ?></option>
							<option value="pre-wrap"><?php echo 'Pre-Wrap'; ?></option>
							<option value="pre-line"><?php echo 'Pre-Line'; ?></option>
						</select>
					</span>

					<!-- ALIGN -->
					<span class="rs-layer-toolbar-box tipsy_enabled_top ho_row_ ho_sltic_ ho_column_" style="padding-right:18px;" id="rs-align-wrapper">
						<i class="rs-mini-layer-icon eg-icon-arrow-combo rs-toolbar-icon" style="margin-right:3px"></i>
						<a href="javascript:void(0)" id='align_left' data-hor="left"  class='revnewgray layer-toolbar-button rs-new-align-button tipsy_enabled_top' title="<?php echo "Layer Align Left"; ?>"><i class="rs-mini-layer-icon rs-icon-alignleft rs-toolbar-icon"></i></a>
						<a href="javascript:void(0)" id='align_center_h' data-hor="center" class='revnewgray layer-toolbar-button rs-new-align-button tipsy_enabled_top' title="<?php echo "Layer Align Center"; ?>"><i class="rs-mini-layer-icon rs-icon-aligncenterh rs-toolbar-icon"></i></a>
						<a href="javascript:void(0)" id='align_right' data-hor="right" class='revnewgray layer-toolbar-button rs-new-align-button tipsy_enabled_top' title="<?php echo "Layer Align Right"; ?>"><i class="rs-mini-layer-icon rs-icon-alignright rs-toolbar-icon"></i></a>									
						<input type="text"  class='text-sidebar' style="display:none" id="layer_align_hor" name="layer_align_hor" value="left" />				

					</span>

					<span class="rs-layer-toolbar-box ho_row_ ho_column_ ho_sltic_">
						<!-- POSITION X -->
						<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Horizontal Offset from Aligned Position (px)"; ?>" style="margin-right:8px"></i>
						<input type="text" data-suffix="px" class="text-sidebar setting-disabled rs-layer-input-field tipsy_enabled_top" title="<?php echo "Horizontal Offset from Aligned Position (px)"; ?>" style="width:60px" id="layer_left" name="layer_left" value="" disabled="disabled">
						<span class="rs-layer-toolbar-space" style="margin-right:10px"></span>

						<!-- POSITION Y -->
						<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Vertical Offset from Aligned Position (px)"; ?>" style="margin-right:4px"></i>
						<input type="text" data-suffix="px" class="text-sidebar setting-disabled rs-layer-input-field tipsy_enabled_top" title="<?php echo "Vertical Offset from Aligned Position (px)"; ?>" style="width:60px" id="layer_top" name="layer_top" value="" disabled="disabled">					
					</span>


					<span class="rs-layer-toolbar-box">	
						<!-- DISPLAY OPTIONS (NONE VISIBLE) -->
						<span class="rs-layer-toolbar-box tipsy_enabled_top" style="display: none">						
							<select id="layer_display" name="layer_display">
								<option value="block" selected="selected"><?php _e('Block', 'revslider'); ?></option>
								<option value="inline-block"><?php _e('Inline-Block', 'revslider'); ?></option>
								<option value="flex"><?php _e('Flex', 'revslider'); ?></option>
								<option value="table"><?php _e('Table', 'revslider'); ?></option>
								<option value="table-cell"><?php _e('Table-Cell', 'revslider'); ?></option>
							</select>
						</span>
						

						<!-- LINE BREAK -->					
						<span id="layer-linebreak-wrapper" class="rs-linebreak-check layer-toolbar-button tipsy_enabled_top ho_column_ ho_row_ ho_group_ ho_svg_" title="<?php _e("Auto Linebreak (on/off - White Space:normal / nowrap).  ",'revslider'); ?>">												
							<input type="checkbox" id="layer_auto_line_break" class="inputCheckbox" name="layer_auto_line_break" >
						</span>

						<!-- DISPLAY MODE -->					
						<span id="layer-displaymode-wrapper" class="rs-displaymode-check layer-toolbar-button tipsy_enabled_top show_on_miw ho_row_ ho_column_ ho_row_ ho_group_ ho_svg_" title="<?php _e("Display Mode Block / Inline-Block).  ",'revslider'); ?>">												
							<input type="checkbox" id="layer_displaymode" class="inputCheckbox" name="layer_displaymode" >						
						</span>
					</span>
				</div>


				<div style="border-top:1px solid #ddd;">

					<!-- FONT FAMILY-->
					<span class="rs-layer-toolbar-box ho_shape_ ho_video_ ho_image_ ho_row_ ho_column_ ho_group_" style="padding-right:0px;">
						<i class="rs-mini-layer-icon rs-icon-fontfamily rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Font Family"; ?>" style="margin-right:10px"></i>
						<input type="text" class="rs-staticcustomstylechange text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Font Family"; ?>" style="width:185px" type="text" id="css_font-family" name="css_font-family" value="" autocomplete="off"> <?php /*  id="font_family" */ ?>
						<span id="css_fonts_down" class="ui-state-active" style="position: relative;"><i class="eg-icon-arrow-combo"></i></span>
						<span class="rs-layer-toolbar-space" style="margin-right:9px"></span>
					</span>



					<!-- FONT DIRECT MANAGEMENT -->
					<span class="rs-layer-toolbar-box ho_shape_ ho_video_ ho_image_ ho_row_ ho_column_ ho_group_">

						<!-- FONT WEIGHT -->
						<i class="rs-mini-layer-icon rs-icon-fontweight rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Font Weight"; ?>"></i>
						<select class="rs-layer-input-field tipsy_enabled_top" title="<?php echo "Font Weight"; ?>" style="width:61px" id="layer_font_weight_s" name="font_weight_static">
							<option value="100">100</option>
							<option value="200">200</option>
							<option value="300">300</option>
							<option value="400">400</option>
							<option value="500">500</option>
							<option value="600">600</option>
							<option value="700">700</option>
							<option value="800">800</option>
							<option value="900">900</option>
						</select>
						<span class="rs-layer-toolbar-space"></span>

						<!-- LETTER SPACING -->
						<i class="rs-mini-layer-icon rs-icon-letterspacing rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Letter Spacing (px)",'revslider'); ?>" style="margin-right:11px" ></i>
						<input type="text" data-suffix="px" class="rs-layer-input-field tipsy_enabled_top" title="<?php _e("Letter Spacing",'revslider'); ?>" style="width:61px" id="letter_spacing_s" name="letter_spacing_static" value="0px" />
						<span class="rs-layer-toolbar-space" style="margin-right:10px" ></span>
						
						<!-- HTML TAG -->
						<span class="ho_shape_ ho_video_ ho_image_ ho_button_ ho_column_ ho_row_ ho_group_">				
							<i class="rs-mini-layer-icon eg-icon-code rs-toolbar-icon tipsy_enabled_top" title="<?php _e("HTML Tag for Layer",'revslider'); ?>"></i>
							<select class="rs-layer-input-field tipsy_enabled_top" title="<?php _e("HTML Tag",'revslider'); ?>" style="width:61px" id="layer_html_tag" name="layer_html_tag">
								<option value="div">&lt;div&gt; - default</option>
								<option value="p">&lt;p&gt;</option>
								<option value="h1">&lt;h1&gt;</option>
								<option value="h2">&lt;h2&gt;</option>
								<option value="h3">&lt;h3&gt;</option>
								<option value="h4">&lt;h4&gt;</option>
								<option value="h5">&lt;h5&gt;</option>
								<option value="h6">&lt;h6&gt;</option>
								<option value="span">&lt;span&gt;</option>
							</select>					
						</span>
					</span>

					<!-- ALIGN -->
					<span class="rs-layer-toolbar-box tipsy_enabled_top ho_sltic_ ho_column_" style="padding-right:18px;" id="rs-align-wrapper-ver">
						<i class="rs-mini-layer-icon eg-icon-arrow-combo rs-toolbar-icon" style="margin-right:3px"></i>															
						<a href="javascript:void(0)" id='align_top' data-ver="top" class='revnewgray layer-toolbar-button rs-new-align-button tipsy_enabled_top' title="<?php echo "Layer Align Top"; ?>"><i class="rs-mini-layer-icon rs-icon-aligntop rs-toolbar-icon"></i></a>
						<a href="javascript:void(0)" id='align_center_v' data-ver="middle" class='revnewgray layer-toolbar-button rs-new-align-button tipsy_enabled_top' title="<?php echo "Layer Align Middle"; ?>"><i class="rs-mini-layer-icon rs-icon-aligncenterv rs-toolbar-icon"></i></a>
						<a href="javascript:void(0)" id='align_bottom' data-ver="bottom" class='revnewgray layer-toolbar-button rs-new-align-button tipsy_enabled_top' title="<?php echo "Layer Align Bottom"; ?>"><i class="rs-mini-layer-icon rs-icon-alignbottom rs-toolbar-icon"></i></a>
						<input type="text"  class='text-sidebar' style="display:none" id="layer_align_vert" name="layer_align_vert" value="top" />
					</span>

					<span class="rs-layer-toolbar-box" style="position:relative">
					

						<!-- IMAGE SIZE -->
						<span id="layer_scaleXY_wrapper" class="ho_row_ ho_column_" style="display:none">
							<i class="rs-mini-layer-icon rs-icon-maxwidth rs-toolbar-icon tipsy_enabled_top " title="<?php echo "Layer Width (px/%). Use 'auto' to respect White Space"; ?>" style="margin-right:3px"></i>						
							<input type="text" data-suffix="px" data-suffixalt="%" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Layer Width (px/%). Use 'auto' to respect White Space"; ?>" style="width:60px" id="layer_scaleX" name="layer_scaleX" value="" data-deepwidth="125" data-selects="Custom %||Custom PX||100%||100px||auto" data-svalues ="50%||150px||100%||100px||auto" data-icons="wrench||wrench||filter||filter||font">						
							<span class="rs-layer-toolbar-space" style="margin-right:11px"></span>						
							<i class="rs-mini-layer-icon rs-icon-maxheight rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Layer Height (px). Use 'auto' to respect White Space"; ?>"></i>						
							<input type="text" data-suffix="px" data-suffixalt="%" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Layer Height (px) Use 'auto' to respect White Space"; ?>" style="width:60px" id="layer_scaleY" name="layer_scaleY" value="" data-deepwidth="125" data-selects="Custom %||Custom PX||100%||100px||auto" data-svalues ="50%||150px||100%||100px||auto" data-icons="wrench||wrench||filter||filter||font">						
						</span>
					<!-- DEFAULT LAYER SIZE -->
						<span id="layer_max_widthheight_wrapper" class="ho_column_">
							<i class="rs-mini-layer-icon rs-icon-maxwidth rs-toolbar-icon tipsy_enabled_top ho_row_" title="<?php _e("Layer Width (px/%). Use 'auto' to respect White Space",'revslider'); ?>" style="margin-right:3px"></i>
							<input type="text" data-suffix="px" data-suffixalt="%" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top ho_row_" title="<?php _e("Layer Width (px/%). Use 'auto' to respect White Space",'revslider'); ?>" style="width:60px" id="layer_max_width" name="layer_max_width" value="auto" data-deepwidth="125" data-selects="Custom %||Custom PX||100%||100px||auto" data-svalues ="50%||150px||100%||100px||auto" data-icons="wrench||wrench||filter||filter||font">						
									<span class="rs-layer-toolbar-space" style="margin-right:11px"></span>
							<i class="rs-mini-layer-icon rs-icon-maxheight rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Layer Height (px). Use 'auto' to respect White Space"; ?>"></i>
							<input type="text" data-suffix="px" data-suffixalt="%" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top " title="<?php echo "Layer Height (px). Use 'auto' to respect White Space"; ?>" style="width:60px" id="layer_max_height" name="layer_max_height" value="auto" data-deepwidth="125" data-selects="Custom %||Custom PX||100%||100px||auto" data-svalues ="50%||150px||100%||100px||auto" data-icons="wrench||wrench||filter||filter||font">
						</span>
						<!-- VIDEO SIZE -->
						<span id="layer_video_widthheight_wrapper" class="ho_row_ ho_column_" style="display:none">
							<i class="rs-mini-layer-icon rs-icon-maxwidth rs-toolbar-icon tipsy_enabled_top " title="<?php echo "Layer Width (px/%). Use 'auto' to respect White Space"; ?>" style="margin-right:3px"></i>						
							<input type="text" data-suffix="px" data-suffixalt="%" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Video Width (px/%). Use 'auto' to respect White Space"; ?>" style="width:60px" id="layer_video_width" name="layer_video_width" value="" data-deepwidth="125" data-selects="Custom %||Custom PX||100%||100px||auto" data-svalues ="50%||150px||100%||100px||auto" data-icons="wrench||wrench||filter||filter||font">					
							<span class="rs-layer-toolbar-space" style="margin-right:11px"></span>
							<i class="rs-mini-layer-icon rs-icon-maxheight rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Layer Height (px). Use 'auto' to respect White Space"; ?>"></i>
							<input type="text" data-suffix="px" data-suffixalt="%" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Video Height (px). Use 'auto' to respect White Space"; ?>" style="width:60px" id="layer_video_height" name="layer_video_height" value="" data-deepwidth="125" data-selects="Custom %||Custom PX||100%||100px||auto" data-svalues ="50%||150px||100%||100px||auto" data-icons="wrench||wrench||filter||filter||font">					
						</span>

						<!-- MIN HEIGHT -->
						<span id="layer_minwidthheight_wrapper" class="ho_column_" style="display:none">
							<i class="rs-mini-layer-icon rs-icon-maxwidth rs-toolbar-icon tipsy_enabled_top ho_column_" title="<?php echo "Min Width of Element. Use 'auto' to respect White Space"; ?>" style="margin-right:3px"></i>						
							<input type="text" data-suffix="px" data-suffixalt="%" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Min Width"; ?>" style="width:60px" id="layer_min_width" name="layer_min_width" value="" data-deepwidth="125" data-selects="Custom %||Custom PX||100%||100px||auto" data-svalues ="50%||150px||100%||100px||auto" data-icons="wrench||wrench||filter||filter||font">
							<span class="rs-layer-toolbar-space" style="margin-right:11px"></span>
							<i class="rs-mini-layer-icon rs-icon-minheight rs-toolbar-icon tipsy_enabled_top " title="<?php echo "Min Height (px)."; ?>"></i>					
							<input type="text" data-suffix="px" class="text-sidebar rs-layer-input-field tipsy_enabled_top " title="<?php echo "Min. Height (px)"; ?>" style="width:60px" id="layer_min_height" name="layer_min_height" value="">											
						</span>

						<!-- RESET ORIGINAL SIZE -->
						<span id="reset-scale" class="ho_column_ ho_row_ ho_group_ ho_svg_ ho_text_ ho_video_ ho_shape_"></span>

						<!-- MEDIA PROPORTION -->
						<span id="layer-prop-wrapper" class="rs-proportion-check layer-toolbar-button ho_column_ ho_row_ ho_svg_" title="<?php echo "Keep Aspect Ratio (on/off)"; ?>">												
							<input type="checkbox" id="layer_proportional_scale" class="inputCheckbox" name="layer_proportional_scale">
						</span>

					</span>

					 
					<span class="rs-layer-toolbar-box">	

						<!-- COVERMODE -->
						<span id="layer-covermode-wrapper" class="tipsy_enabled_top ho_row_ ho_column_" title="<?php echo "Cover Mode"; ?>">						
							<i class="rs-mini-layer-icon rs-toolbar-icon rs-cover-size-icon"></i>
							<select class="rs-layer-input-field"  style="width:75px" id="layer_cover_mode" name="layer_cover_mode">
								<option value="custom"><?php echo 'Custom'; ?></option>
								<option value="fullwidth"><?php echo 'Full Width'; ?></option>
								<option value="fullheight"><?php echo 'Full Height'; ?></option>
								<option value="cover"><?php echo 'Stretch'; ?></option>
								<option value="cover-proportional"><?php echo 'Cover'; ?></option>
							</select>
						</span>
						
					</span>
				</div>


				<!-- SUB SETTINGS FOR CSS -->
				<div id="style_form_wrapper">
					<div id="extra_style_settings" class="extra_sub_settings_wrapper" >
						<div class="close_extra_settings"></div>
						<div class="inner-settings-wrapper">
							<div id="tp-idle-state-advanced-style" style="float:left; padding-left:20px;">
								
								<ul class="rs-layer-animation-settings-tabs" style="display:inline-block; ">
									<li data-content="#style-sub-font" class="selected ho_row_ ho_column_ ho_group_ ho_image_ ho_shape_"><?php echo "Font"; ?></li>
									<li data-content="#style-sub-background"><?php echo "Background"; ?></li>
									<li data-content="#style-sub-spaces"><?php echo "Spaces"; ?></li>
									<li data-content="#style-sub-border"><?php echo "Border"; ?></li>
									<li data-content="#style-sub-transfrom" ><?php echo "Transform"; ?></li>
									<li data-content="#style-sub-rotation" ><?php echo "Rotation"; ?></li>
									<li data-content="#style-sub-perspective"><?php echo "Perspective"; ?></li>
									<li data-content="#style-sub-filters"><?php echo "Filters"; ?></li>
									<!--<li data-content="#style-sub-shadows"><?php echo "Shadow"; ?></li>-->
									<li data-content="#style-sub-svg" class="ho_row_ ho_column_ ho_group_ ho_image_ ho_shape_ ho_video_ ho_button_"><?php echo "SVG"; ?></li>
									<li data-content="#style-sub-sharpc" class="ho_row_ ho_column_ ho_group_ ho_image_"><?php echo "Corners"; ?></li>								
									<li data-content="#style-sub-advcss"><?php echo "Advanced CSS"; ?></li>		
									<li data-content="#style-sub-hover"><?php echo "Hover"; ?></li>
									<li data-content="#style-sub-toggle"><?php echo "Toggle"; ?></li>		
								</ul>
								<div style="width:100%;height:1px;display:block"></div>

								<!-- FILTERS IDLE -->							
								<span id="style-sub-filters" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!-- BLUR IDLE -->
									<i class="rs-mini-layer-icon fa-icon-spinner rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Blur",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																	
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Blur",'revslider'); ?>"  id="blurfilter_idle" name="blurfilter_idle" value="0" data-selects="0||Custom||3||10" data-svalues ="0||5||3||10" data-icons="minus||shuffle||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- grayscale IDLE -->
									<i class="rs-mini-layer-icon fa-icon-adjust rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Grayscale",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																
									<input data-suffix="%" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Grayscale",'revslider'); ?>"  id="grayscalefilter_idle" name="grayscalefilter_idle" value="0"  data-selects="0||Custom||25%||100%" data-svalues ="0||50||25||100" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- brightness IDLE -->
									<i class="rs-mini-layer-icon fa-icon-adjust rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Brightness",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																
									<input data-suffix="%" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("brightness",'revslider'); ?>"  id="brightnessfilter_idle" name="brightnessfilter_idle" value="100"  data-selects="100%||Custom||50%||150%" data-svalues ="100||125||50||150" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- BLEND MODE -->
									<i class="rs-mini-layer-icon fa-icon-star-half-empty rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Blend Mode (Not available for IE)",'revslider'); ?>" style="margin-right:10px"></i>
									<select class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php _e("Blend Mode (Not available for IE)",'revslider'); ?>" style="width:100px;cursor:pointer" id="layer_blend_mode" name="layer_blend_mode">
										<option value="normal"><?php _e('normal', 'revslider'); ?></option>
										<option value="multiply"><?php _e('multiply', 'revslider'); ?></option>
										<option value="screen"><?php _e('screen', 'revslider'); ?></option>
										<option value="overlay"><?php _e('overlay', 'revslider'); ?></option>
										<option value="darken"><?php _e('darken', 'revslider'); ?></option>
										<option value="lighten"><?php _e('lighten', 'revslider'); ?></option>
										<option value="color-dodge"><?php _e('color-dodge', 'revslider'); ?></option>
										<option value="color-burn"><?php _e('color-burn', 'revslider'); ?></option>
										<option value="hard-light"><?php _e('hard-light', 'revslider'); ?></option>
										<option value="soft-light"><?php _e('soft-light', 'revslider'); ?></option>
										<option value="difference"><?php _e('difference', 'revslider'); ?></option>
										<option value="exclusion"><?php _e('exclusion', 'revslider'); ?></option>
										<option value="hue"><?php _e('hue', 'revslider'); ?></option>
										<option value="saturation"><?php _e('saturation', 'revslider'); ?></option>
										<option value="color"><?php _e('color', 'revslider'); ?></option>
										<option value="luminosity"><?php _e('luminosity', 'revslider'); ?></option>									
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								</span>
								<!-- SHADOW IDLE -->							
								<span id="style-sub-shadows" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!--Force Straight Hover Rendering -->
									
									<input id="shadow_idle" name="shadow_idle" type="checkbox" class="tp-moderncheckbox" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<!-- DROP SHADOW -->								
									<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon " style="margin-right:8px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="ds_x_idle" name="ds_x_idle" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon " style="margin-right:4px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="ds_y_idle" name="ds_y_idle" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<i class="rs-mini-layer-icon fa-icon-spinner rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Blur Radius"; ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Blur Radius"; ?>"  id="ds_blur_idle" name="ds_blur_idle" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<!--<i class="rs-mini-layer-icon fa-icon-bullseye rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Spread Radius"; ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Spread Radius"; ?>"  id="ds_spread_idle" name="ds_spread_idle" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>-->
									<!-- SHADOW COLOR START-->								
									<input type="text" class="rs-staticcustomstylechange rs-layer-input-field my-color-field tipsy_enabled_top" title="<?php echo "Shadow Color"; ?>" style="width:150px" id="ds_color_idle" name="ds_color_idle" value="transparent" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- SHADOW OPACITY START-->
									<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Shadow Opacity"; ?>" style="margin-right:10px"></i>
									<input data-suffix="" data-steps="0.05" data-min="0" data-max="1" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Shadow Opacity"; ?>" style="width:50px" type="text" id="ds_opacity_idle" name="ds_opacity_idle" value="1">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									
								</span>


								<span id="style-sub-font" class="rs-layer-toolbar-box ho_shape_ ho_video_ ho_image_ ho_row_ ho_column_ ho_group_" style="display:block">

			 
									<!-- ITALIC -->
									<i class="rs-mini-layer-icon rs-icon-italic rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Italic Font"; ?>" style="margin-right:10px"></i>
									<input type="checkbox" id="css_font-style" name="css_font-style" class="rs-staticcustomstylechange tipsy_enabled_top tp-moderncheckbox" title="<?php echo "Italic Font On/Off"; ?>">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- DECORATION -->
									<i class="rs-mini-layer-icon rs-icon-decoration rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Font Decoration"; ?>" style="margin-right:10px"></i>
									<select class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Font Decoration"; ?>" style="width:100px;cursor:pointer" id="css_text-decoration" name="css_text-decoration">
										<option value="none"><?php echo 'none'; ?></option>
										<option value="underline"><?php echo 'underline'; ?></option>
										<option value="overline"><?php echo 'overline'; ?></option>
										<option value="line-through"><?php echo 'line-through'; ?></option>
									</select>

									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- TEXT TRANSFORM -->
									<i class="rs-mini-layer-icon rs-icon-transform rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Text Transform"; ?>" style="margin-right:10px"></i>
									<select class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Text Transform"; ?>" style="width:100px;cursor:pointer" id="css_text-transform" name="css_text-transform">
										<option value="none"><?php echo 'None'; ?></option>
										<option value="lowercase"><?php echo 'Lowercase'; ?></option>
										<option value="uppercase"><?php echo 'Uppercase'; ?></option>
										<option value="capitalize"><?php echo 'Capitalize'; ?></option>
									</select>


									

								

									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- LAYER SELECTABLE -->
									<i class="rs-mini-layer-icon eg-icon-lightbulb rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Layer is Selectable"; ?>" style="margin-right:10px"></i>
									<!--input type="checkbox" id="css_layer_selectable" name="css_layer_selectable-style" class="rs-staticcustomstylechange tipsy_enabled_top tp-moderncheckbox" title="<?php echo "Layer is Selectable / Markable on Frontend"; ?>"-->
									<select class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Layer is Selectable / Markable on Frontend"; ?>" style="width:100px;cursor:pointer" id="css_layer_selectable" name="css_layer_selectable-style">
										<option value="default"><?php echo 'Default'; ?></option>
										<option value="off"><?php echo 'Off'; ?></option>
										<option value="on"><?php echo 'On'; ?></option>
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									
								</span>
 
								<span id="style-sub-background" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!-- BACKGROUND COLOR -->
									<i class="rs-mini-layer-icon rs-icon-bg rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Background Color"; ?>" style="margin-right:10px"></i>
									<input type="text" class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top my-color-field" title="<?php _e("Background Color",'revslider'); ?>" data-editing="Layer Background Color" style="width:150px" id="css_background-color" name="css_background-color" value="transparent" />
									<span class="rs-layer-toolbar-space"></span>
 
									
									<span class="ho_image_ ho_video_ ho_audio_ ho_image_ ">
										<!-- BACKGROUND IMAGE FOR CERTAIN LAYERS -->
										<i class="rs-mini-layer-icon eg-icon-picture-1 rs-toolbar-icon tipsy_enabled_top" title="<?php echo 'Background Image'; ?>" style="margin-right:10px"></i>
										<a href="javascript:void(0)" id="button_change_background_image" class="button-primary revblue" ><i class="prestashop-icon"></i></a>
										<a href="javascript:void(0)" id="button_change_background_image_objlib" class="button-primary revpurple" ><i class="fa-icon-book"></i></a>
										<a href="javascript:void(0)" id="button_clear_background_image" class="button-primary revred" ><i class="fa-icon-trash"></i></a>
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
											
										<!-- BACKGROUND POSITION ALIGN -->
										<i class="rs-mini-layer-icon eg-icon-move rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Background Position"; ?>" style="margin-right:5px"></i>
										<select class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Background Position"; ?>" style="width:100px;cursor:pointer" id="layer_bg_position" name="layer_bg_position">
											<option value="left top"><?php echo 'Left Top'; ?></option>
											<option value="center top"><?php echo 'Center Top'; ?></option>
											<option value="right top"><?php echo 'Right Top'; ?></option>
											<option value="left center"><?php echo 'Left Center'; ?></option>
											<option value="center center"><?php echo 'Center Center'; ?></option>
											<option value="right center"><?php echo 'Right Center'; ?></option>
											<option value="left bottom"><?php echo 'Left Bottom'; ?></option>
											<option value="center bottom"><?php echo 'Center Bottom'; ?></option>
											<option value="right bottom"><?php echo 'Right Bottom'; ?></option>
										</select>
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

										<!-- BACKGROUND SIZE  -->
										<i class="rs-mini-layer-icon fa-icon-arrows-alt rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Background Size"; ?>"></i>
										<select class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Background Size"; ?>" style="width:100px;cursor:pointer" id="layer_bg_size" name="layer_bg_size">
											<option value="cover"><?php echo 'Cover'; ?></option>
											<option value="contain"><?php echo 'Contain'; ?></option>
										</select>
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
										
										<!-- BACKGROUND REPEAT  -->
										<i class="rs-mini-layer-icon  fa-icon-th-large rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Background Repeat"; ?>" ></i>
										<select class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo 'Background Repeat'; ?>" style="width:100px;cursor:pointer" id="layer_bg_repeat" name="layer_bg_repeat">
											<option value="no-repeat">no-repeat</option>
											<option value="repeat">repeat</option>
											<option value="repeat-x">repeat-x</option>
											<option value="repeat-y">repeat-y</option>
										</select>
									</span>
								</span>

								<!-- LAYER SPACING'S -->
								<span id="style-sub-spaces" class="rs-layer-toolbar-box" style="display:none;border:none;">
									
									
									<!-- PADDING -->
									<i class="rs-mini-layer-icon rs-icon-padding rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Padding"; ?>" style="margin-right:10px"></i>
									<input data-suffix="px" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Padding Top"; ?>" style="width:50px" type="text" name="css_padding[]" value="">
									<input data-suffix="px" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Padding Right"; ?>" style="width:50px" type="text" name="css_padding[]" value="">
									<input data-suffix="px" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Padding Bottom"; ?>" style="width:50px" type="text" name="css_padding[]" value="">
									<input data-suffix="px" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Padding Left"; ?>" style="width:50px" type="text" name="css_padding[]" value="">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- MARGIN -->
									<i class="rs-mini-layer-icon rs-icon-margin rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Margin"; ?>" style="margin-right:10px"></i>
									<input data-suffix="px" class="rs-staticcustomstylechange margin-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Margin Top"; ?>" style="width:50px" type="text" name="css_margin[]" value="">
									<input data-suffix="px" class="rs-staticcustomstylechange margin-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Margin Right"; ?>" style="width:50px" type="text" name="css_margin[]" value="">
									<input data-suffix="px" class="rs-staticcustomstylechange margin-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Margin Bottom"; ?>" style="width:50px" type="text" name="css_margin[]" value="">
									<input data-suffix="px" class="rs-staticcustomstylechange margin-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Margin Left"; ?>" style="width:50px" type="text" name="css_margin[]" value="">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									
									<!-- TEXT ALIGN -->
									<i class="ho_row_ rs-mini-layer-icon rs-icon-text-align rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Text Align"; ?>" style="margin-right:10px"></i>
									<select class="ho_row_ rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Text Align"; ?>" style="width:100px;cursor:pointer" id="css_text-align" name="css_text-align">
										<option value="inherit"><?php echo 'Inherit'; ?></option>
										<option value="left"><?php echo 'Left'; ?></option>
										<option value="center"><?php echo 'Center'; ?></option>
										<option value="right"><?php echo 'Right'; ?></option>
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- TEXT ALIGN VERTICAL (NOT USED YET, NOT VISIBLE !!)-->
									<i class="ho_row_ ho_image_ ho_shape_ ho_button_ ho_video_ ho_svg_ ho_sltic_ ho_text_ rs-mini-layer-icon rs-icon-vertical-align rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Vertical Align ",'revslider'); ?>" style="margin-right:10px"></i>
									<select class="ho_row_ ho_image_ ho_shape_ ho_button_ ho_video_ ho_svg_ ho_sltic_ ho_text_ rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php _e("Vertical Align",'revslider'); ?>" style="width:100px;cursor:pointer" id="css_vertical-align" name="css_vertical-align">
										<option value="top"><?php _e('Top', 'revslider'); ?></option>
										<option value="middle"><?php _e('Middle', 'revslider'); ?></option>
										<option value="bottom"><?php _e('Bottom', 'revslider'); ?></option>
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- ROW BREAK (NOT VISIBLE !!) -->								
									<select style="display:none" class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Columns Break at"; ?>" style="width:100px;cursor:pointer" id="column_break_at" name="column_break_at">
										<option value="notebook"><?php echo 'notebook'; ?></option>
										<option value="tablet"><?php echo 'tablet'; ?></option>
										<option value="mobile" selected="selected"><?php echo 'mobile'; ?></option>
									</select>


									<!-- OVERFLOW (HIDDEN/VISIBLE) ONLY FOR GROUPS FIRST -->
									<i class="ho_row_ ho_column_ ho_image_ ho_shape_ ho_button_ ho_video_ ho_svg_ ho_sltic_ ho_text_ rs-mini-layer-icon fa-icon-object-group rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Overflow"; ?>" style="margin-right:10px"></i>
									<select class="ho_row_ ho_column_ ho_image_ ho_shape_ ho_button_ ho_video_ ho_svg_ ho_sltic_ ho_text_ rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Overflow"; ?>" style="width:100px;cursor:pointer" id="css_overflow" name="css_overflow">
										<option value="visible"><?php echo 'Visible'; ?></option>
										<option value="hidden"><?php echo 'Hidden'; ?></option>									
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									
								</span>

								<span id="style-sub-border" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!-- BORDER COLOR -->
									<i class="rs-mini-layer-icon rs-icon-bordercolor rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Border Color"; ?>" style="margin-right:10px"></i>
									<input type="text" class="rs-staticcustomstylechange my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("Border Color",'revslider'); ?>"  data-editing="Layer Border Color" data-mode="single" style="width:150px" id="css_border-color-show" name="css_border-color-show" value="transparent" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
 
									<!-- BORDER STYLE -->
									<i class="rs-mini-layer-icon rs-icon-borderstyle rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Border Style"; ?>" style="margin-right:10px"></i>
									<select class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Style"; ?>" style="width:100px cursor:pointer" id="css_border-style" name="css_border-style">
										<option value="none"><?php echo 'none'; ?></option>
										<option value="dotted"><?php echo 'dotted'; ?></option>
										<option value="dashed"><?php echo 'dashed'; ?></option>
										<option value="solid"><?php echo 'solid'; ?></option>
										<option value="double"><?php echo 'double'; ?></option>
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- BORDER WIDTH-->
									<i class="rs-mini-layer-icon rs-icon-borderwidth rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Border Width"; ?>" style="margin-right:10px"></i>
									<input data-suffix="px" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Width Top"; ?>" style="width:50px" type="text" name="css_border-width[]" value="0">
									<input data-suffix="px" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Width Right"; ?>" style="width:50px" type="text" name="css_border-width[]" value="0">
									<input data-suffix="px" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Width Bottom"; ?>" style="width:50px" type="text" name="css_border-width[]" value="0">
									<input data-suffix="px" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Width Left"; ?>" style="width:50px" type="text" name="css_border-width[]" value="0">
									
									<span class="rs-layer-toolbar-space" style="margin-right:16px"></span>

									<!-- BORDER RADIUS -->
									<i class="rs-mini-layer-icon rs-icon-borderradius rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Border Radius (px)"; ?>" style="margin-right:10px"></i>
									<input data-suffix="px" data-suffixalt="%" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" data-steps="1" data-min="0"  title="<?php echo "Border Radius Top Left"; ?>" style="width:50px" type="text" name="css_border-radius[]" value="">
									<input data-suffix="px" data-suffixalt="%" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" data-steps="1" data-min="0" title="<?php echo "Border Radius Top Right"; ?>" style="width:50px" type="text" name="css_border-radius[]" value="">
									<input data-suffix="px" data-suffixalt="%" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" data-steps="1" data-min="0" title="<?php echo "Border Radius Bottom Right"; ?>" style="width:50px" type="text" name="css_border-radius[]" value="">
									<input data-suffix="px" data-suffixalt="%" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" data-steps="1" data-min="0" title="<?php echo "Border Radius Bottom Left"; ?>" style="width:50px" type="text" name="css_border-radius[]" value="">
								</span>

							
								<span id="style-sub-rotation" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!--  X  ROTATE -->
									<i class="rs-mini-layer-icon rs-icon-rotationx rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Rotation on X axis (+/-)"; ?>"></i>
									<input data-suffix="deg" type="text" style="width:55px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Rotation on X axis (+/-)"; ?>" id="layer__xrotate" name="layer__xrotate" value="0">
									<span class="rs-layer-toolbar-space"></span>
									<!--  Y ROTATE -->
									<i class="rs-mini-layer-icon rs-icon-rotationy rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Rotation on Y axis (+/-)"; ?>"></i>
									<input data-suffix="deg" type="text" style="width:55px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Rotation on Y axis (+/-)"; ?>" id="layer__yrotate" name="layer__yrotate" value="0">
									<span class="rs-layer-toolbar-space"></span>

									<!--  Z ROTATE -->
									<i class="rs-mini-layer-icon rs-icon-rotationz rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Rotation on Z axis (+/-)"; ?>"></i>
									<input data-suffix="deg" type="text" style="width:55px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Rotation on Z axis (+/-)"; ?>" id="layer_2d_rotation" name="layer_2d_rotation" value="0">
									<span class="rs-layer-toolbar-space" style="margin-right:15px;"></span>
									
									<!-- ORIGIN X -->
									<i class="rs-mini-layer-icon rs-icon-originx rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Horizontal Origin"; ?>"></i>
									<input data-suffix="%" type="text" style="width:55px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Horizontal Origin"; ?>" id="layer_2d_origin_x" name="layer_2d_origin_x" value="50">
									<span class="rs-layer-toolbar-space"></span>
									<!-- ORIGIN Y -->
									<i class="rs-mini-layer-icon rs-icon-originy rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Vertical Origin"; ?>"></i>
									<input data-suffix="%" type="text" style="width:55px;" class="textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Vertical Origin"; ?>" id="layer_2d_origin_y" name="layer_2d_origin_y" value="50">
						
								</span>

								<span id="style-sub-transfrom" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!-- OPACITY -->
									<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Opacity. (1 = 100% Visible / 0.5 = 50% opacaity / 0 = transparent)"; ?>" style="margin-right:8px"></i>
									<input data-suffix="" data-steps="0.05" data-min="0" data-max="1"  type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Opacity (1 = 100% Visible / 0.5 = 50% opacaity / 0 = transparent)"; ?>" id="layer__opacity" name="layer__opacity" value="1">
									<span class="rs-layer-toolbar-space" style="margin-right:15px;"></span>
									
									<!-- SCALE X -->
									<i class="rs-mini-layer-icon rs-icon-scalex rs-toolbar-icon tipsy_enabled_top" title="<?php echo "X Scale  1 = 100%, 0.5=50%... (+/-)"; ?>" style="margin-right:4px"></i>
									<input data-suffix="" data-steps="0.01" data-min="0" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "X Scale  1 = 100%, 0.5=50%... (+/-)"; ?>" id="layer__scalex" name="layer__scalex" value="1">
									<span class="rs-layer-toolbar-space" style="margin-right:15px;"></span>
									
									<!-- SCALE Y -->
									<i  class="rs-mini-layer-icon rs-icon-scaley rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Y Scale  1 = 100%, 0.5=50%... (+/-)"; ?>" style="margin-right:8px"></i>
									<input data-suffix="" data-steps="0.01"  data-min="0" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Y Scale  1 = 100%, 0.5=50%... (+/-)"; ?>" id="layer__scaley" name="layer__scaley" value="1">
									<span class="rs-layer-toolbar-space" style="margin-right:15px;"></span>
									
									<!-- SKEW X -->
									<i class="rs-mini-layer-icon rs-icon-skewx rs-toolbar-icon tipsy_enabled_top" title="<?php echo "X Skew (+/-  px)"; ?>" style="margin-right:4px"></i>
									<input data-suffix="px" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field  tipsy_enabled_top" title="<?php echo "X Skew (+/-  px)"; ?>" id="layer__skewx" name="layer__skewx" value="0">
									<span class="rs-layer-toolbar-space" style="margin-right:15px;"></span>
									
									<!-- SKEW Y -->
									<i class="rs-mini-layer-icon rs-icon-skewy rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Y Skew (+/-  px)"; ?>" style="margin-right:8px"></i>
									<input data-suffix="px" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Y Skew (+/-  px)"; ?>" id="layer__skewy" name="layer__skewy" value="0">
						
								</span>

								<!-- ADVANCED CSS -->
								<span id="style-sub-advcss" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<div id="advanced-css-main" class="rev-advanced-css-idle advanced-copy-button"><?php echo "Template"; ?></div>
									<div id="advanced-css-layer" class="rev-advanced-css-idle-layer advanced-copy-button"><?php echo "Layer"; ?></div>
								</span>
								
								<?php $easings = $operations->getArrEasing(); ?>
								
								<!-- CAPTION HOVER CSS -->
								<span id="style-sub-hover" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!-- Caption Hover on/off -->
									<span><?php echo "Layer Hover"; ?></span>
									<span class="rs-layer-toolbar-space"></span>
									<input id="hover_allow" name="hover_allow" type="checkbox" class="tp-moderncheckbox" />
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>
									
									<!-- ANIMATION START SPEED -->
									<i class="rs-mini-layer-icon rs-icon-clock rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Hover Animation Speed (in ms)"; ?>"></i>
									<input type="text" style="width:90px; padding-right:10px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Hover Animation Speed (in ms)"; ?>" id="hover_speed" name="hover_speed" value="">
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>
									
									
									<!-- HOVER EASE -->
									<i class="rs-mini-layer-icon rs-icon-easing rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Hover Animation Easing"; ?>"></i>
									<select class="rs-layer-input-field tipsy_enabled_top" title="<?php echo "Hover Animation Easing"; ?>" style="width:140px"  id="hover_easing" name="hover_easing">
										<?php
										foreach($easings as $ehandle => $ename){
											echo '<option value="'.$ehandle.'">'.$ename.'</option>';
										}
										?>
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

									<!-- CURSOR -->
									<i class="rs-mini-layer-icon eg-icon-up-hand rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Mouse Cursor"; ?>" style="margin-right:10px"></i>
									<select class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top" title="<?php echo "Mouse Cursor"; ?>" style="width:100px cursor:pointer" id="css_cursor" name="css_cursor">
										<option value="auto"><?php echo 'auto'; ?></option>
										<option value="default"><?php echo 'default'; ?></option>
										<option value="crosshair"><?php echo 'crosshair'; ?></option>
										<option value="pointer"><?php echo 'pointer'; ?></option>
										<option value="move"><?php echo 'move'; ?></option>
										<option value="text"><?php echo 'text'; ?></option>
										<option value="wait"><?php echo 'wait'; ?></option>
										<option value="help"><?php echo 'help'; ?></option>
										<option value="zoom-in"><?php echo 'zoom-in'; ?></option>
										<option value="zoom-out"><?php echo 'zoom-out'; ?></option>
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>
									
									<!-- HOVER Z-INDEX -->
									<i class="rs-mini-layer-icon eg-icon-resize-vertical rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Z-Index"; ?>" style="margin-right:10px"></i>
									<input type="text" style="width:90px; padding-right:10px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Hover Z-Index (Enter z-index level or enter auto for default value)"; ?>" id="hover_zindex" name="hover_zindex" value="auto">
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>
                                                                        
									<!-- POINTER EVENTS -->
									<i class="rs-mini-layer-icon eg-icon-gamepad rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Pointer Events",'revslider'); ?>" style="margin-right:10px"></i>
									<select class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top" title="<?php _e("Pointer Events",'revslider'); ?>" style="width:100px cursor:pointer" id="pointer_events" name="pointer_events">
										<option value="auto"><?php _e('auto', 'revslider'); ?></option>
										<option value="none"><?php _e('none', 'revslider'); ?></option>
									</select>
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>
									
									<!--Force Straight Hover Rendering -->
									<div style="display:none !important">
										<span><?php echo "Force Animation"; ?></span>
										<span class="rs-layer-toolbar-space"></span>
										<input id="force_hover" name="force_hover" type="checkbox" class="tp-moderncheckbox" />
									</div>
									
									
									
								</span>

								<!-- LAYER TOGGLE SETTINGS -->
								<span id="style-sub-toggle" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!-- Toggle Hover on/off -->
									<span><?php echo "Layer Toggle Mode"; ?></span>
									<span class="rs-layer-toolbar-space"></span>
									<input id="toggle_allow" name="toggle_allow" type="checkbox" class="tp-moderncheckbox" />
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

									<!-- Toggle ACTIVE Mode -->
									<span><?php echo "Use Hover Style when Toggle is Active"; ?></span>
									<span class="rs-layer-toolbar-space"></span>
									<input id="toggle_use_hover" name="toggle_use_hover" type="checkbox" class="tp-moderncheckbox" />
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>								

									<!-- Toggle Invers Mode -->
									<span><?php echo "Invers Toggle Content"; ?></span>
									<span class="rs-layer-toolbar-space"></span>
									<input id="toggle_inverse_content" name="toggle_inverse_content" type="checkbox" class="tp-moderncheckbox" />
									<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>								
									
								</span>

								

								<span id="style-sub-perspective" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!-- PERSPECTIVE -->
									<i class="rs-mini-layer-icon rs-icon-perspective rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Animation Perspective (default 600)"; ?>" style="margin-right:8px"></i>
									<input type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Animation Perspective (default 600)"; ?>" id="layer__pers" name="layer__pers" value="600">
									<span class="rs-layer-toolbar-space"></span>

									<!-- Z - OFFSET -->
									<i class="rs-mini-layer-icon rs-icon-zoffset rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Z Offset (+/-  px)"; ?>" style="margin-right:4px"></i>
									<input data-suffix="px" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Z Offset (+/-  px)"; ?>" id="layer__z" name="layer__z" value="0">
								</span>
								
								
								<span id="style-sub-sharpc" class="rs-layer-toolbar-box" style="display:none;border:none;">

									<span><?php echo "Sharp Left"; ?></span>
									<span class="rs-layer-toolbar-space"></span>
									<select id="layer_cornerleft" name="layer_cornerleft" class="rs-layer-input-field" style="width:175px">
										<option value="nothing" selected="selected"><?php echo "No Corner"; ?></option>
										<option value="curved"><?php echo "Sharp"; ?></option>
										<option value="reverced"><?php echo "Sharp Reversed"; ?></option>
									</select>
									<span class="rs-layer-toolbar-space"></span>
		
									<span><?php echo "Sharp Right"; ?></span>
									<span class="rs-layer-toolbar-space"></span>
									<select id="layer_cornerright" name="layer_cornerright" class="rs-layer-input-field" style="width:175px">
										<option value="nothing" selected="selected"><?php echo "No Corner"; ?></option>
										<option value="curved"><?php echo "Sharp"; ?></option>
										<option value="reverced"><?php echo "Sharp Reversed"; ?></option>
									</select>

								</span>

								<span id="style-sub-svg" class="rs-layer-toolbar-box" style="display:none;border:none;">

									<!-- SVG STROKE COLOR -->
									<i class="rs-mini-layer-icon rs-icon-bordercolor rs-toolbar-icon tipsy_enabled_top" title="<?php echo "SVG Stroke Color"; ?>" style="margin-right:10px"></i>
									<input type="text" class="rs-staticcustomstylechange my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("SVG Stroke Color",'revslider'); ?>"  style="width:150px" id="css_svgstroke-color-show" data-editing="SVG Stroke Color" data-mode="single" name="css_svgstroke-color-show" value="transparent" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

								 	<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- SVG STROKE WIDTH-->
									<i class="rs-mini-layer-icon rs-icon-borderwidth rs-toolbar-icon tipsy_enabled_top" title="<?php echo "SVG Stroke Width"; ?>" style="margin-right:10px"></i>
									<input data-suffix="px" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "SVG Stroke Width"; ?>" style="width:50px" type="text" id="css_svgstroke-width" name="css_svgstroke-width" value="0">
									<span class="rs-layer-toolbar-space" style="margin-right:16px"></span>
									
									<!-- SVG STROKE DASHARRAY -->
									<i class="rs-mini-layer-icon rs-icon-borderstyle rs-toolbar-icon tipsy_enabled_top" title="<?php echo "SVG Stroke Dasharray"; ?>" style="margin-right:10px"></i>
									<input type="text" class="rs-layer-input-field tipsy_enabled_top" style="width:61px" id="css_svgstroke-dasharray" name="css_svgstroke-dasharray" value="" original-title="<?php echo "SVG Stroke Dash Array"; ?>">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- SVG STROKE DASH OFFSET -->
									<i style="transform: rotateZ(90deg);-webkit-transform: rotateZ(90deg);" class="rs-mini-layer-icon eg-icon-arrow-combo rs-toolbar-icon tipsy_enabled_top" title="<?php echo "SVG Stroke Dash Offset"; ?>" style="margin-right:3px"></i>
									<input type="text" class="rs-layer-input-field tipsy_enabled_top" style="width:61px" id="css_svgstroke-dashoffset" name="css_svgstroke-dashoffset" value="" original-title="<?php echo "SVG Stroke Dash Offset"; ?>">

								</span>
							</div>
							
							<!-- THE HOVER STLYE PART -->
							<div id="tp-hover-state-advanced-style" style="float:left;display:none; padding-left:20px;">
									<ul class="rs-layer-animation-settings-tabs" style="display:inline-block;min-width:615px ">
										<li data-content="#hover-sub-font" class="selected"><?php echo "Font"; ?></li>
										<li data-content="#hover-sub-background"><?php echo "Background"; ?></li>
										<li data-content="#hover-sub-border"><?php echo "Border"; ?></li>
										<li data-content="#hover-sub-svg"><?php echo "SVG"; ?></li>
										<li data-content="#hover-sub-filters"><?php echo "Filters"; ?></li>
										<!--<li data-content="#hover-sub-shadows"><?php echo "Shadow"; ?></li>-->
										<li data-content="#hover-sub-transform"><?php echo "Transform"; ?></li>
										<li data-content="#hover-sub-rotation" ><?php echo "Rotation"; ?></li>
										<li data-content="#hover-sub-advcss" ><?php echo "Advanced CSS"; ?></li>
									</ul>

									<div style="width:100%;height:1px;display:block"></div>

									<!-- FILTERS IN -->							
								<span id="hover-sub-filters" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!-- BLUR HOVER -->
									<i class="rs-mini-layer-icon fa-icon-spinner rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Blur",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																	
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Blur",'revslider'); ?>"  id="blurfilter_hover" name="blurfilter_hover" value="0" data-selects="0||Custom||3||10" data-svalues ="0||5||3||10" data-icons="minus||shuffle||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- grayscale HOVER -->
									<i class="rs-mini-layer-icon fa-icon-adjust rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Grayscale",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																
									<input data-suffix="%" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Grayscale",'revslider'); ?>"  id="grayscalefilter_hover" name="grayscalefilter_hover" value="0"  data-selects="0||Custom||25%||100%" data-svalues ="0||50||25||100" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- brightness HOVER -->
									<i class="rs-mini-layer-icon fa-icon-adjust rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Brightness",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																
									<input data-suffix="%" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("brightness",'revslider'); ?>"  id="brightnessfilter_hover" name="brightnessfilter_hover" value="100"  data-selects="100%||Custom||50%||150%" data-svalues ="100||125||50||150" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									
								</span>

								<!-- SHADOW IN -->							
								<span id="hover-sub-shadows" class="rs-layer-toolbar-box" style="display:none;border:none;">
									<!--Force Straight Hover Rendering -->
									
									<input id="shadow_hover" name="shadow_hover" type="checkbox" class="tp-moderncheckbox" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<!-- DROP SHADOW -->								
									<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon " style="margin-right:8px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="ds_x_hover" name="ds_x_hover" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon " style="margin-right:4px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="ds_y_hover" name="ds_y_hover" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<i class="rs-mini-layer-icon fa-icon-spinner rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Blur Radius"; ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Blur Radius"; ?>"  id="ds_blur_hover" name="ds_blur_hover" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<!--<i class="rs-mini-layer-icon fa-icon-bullseye rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Spread Radius"; ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Spread Radius"; ?>"  id="ds_spread_hover" name="ds_spread_hover" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>-->
									<!-- SHADOW COLOR START-->								
									<input type="text" class="rs-staticcustomstylechange rs-layer-input-field my-color-field tipsy_enabled_top" title="<?php echo "Shadow Color"; ?>" style="width:150px" id="ds_color_hover" name="ds_color_hover" value="transparent" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- SHADOW OPACITY START-->
									<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Shadow Opacity"; ?>" style="margin-right:10px"></i>
									<input data-suffix="" data-steps="0.05" data-min="0" data-max="1" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Shadow Opacity"; ?>" style="width:50px" type="text" id="ds_opacity_hover" name="ds_opacity_hover" value="1">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									
								</span>


									<span id="hover-sub-svg" class="rs-layer-toolbar-box" style="display:none;border:none;">

										<!-- SVG STROKE COLOR -->
										<i class="rs-mini-layer-icon rs-icon-bordercolor rs-toolbar-icon tipsy_enabled_top" title="<?php echo "SVG Stroke Color"; ?>" style="margin-right:10px"></i>
										<input type="text" class="rs-staticcustomstylechange my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("SVG Stroke Color",'revslider'); ?>"  style="width:150px" id="css_svgstroke-hover-color-show" data-editing="SVG Stroke Hover Color" data-mode="single" name="css_svgstroke-hover-color-show" value="transparent" />
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

										<!-- SVG STROKE WIDTH-->
										<i class="rs-mini-layer-icon rs-icon-borderwidth rs-toolbar-icon tipsy_enabled_top" title="<?php echo "SVG Stroke Width"; ?>" style="margin-right:10px"></i>
										<input data-suffix="px" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "SVG Stroke Width"; ?>" style="width:50px" type="text" id="css_svgstroke-hover-width" name="css_svgstroke-hover-width" value="0">
										<span class="rs-layer-toolbar-space" style="margin-right:16px"></span>
										
										<!-- SVG STROKE DASHARRAY -->
										<i class="rs-mini-layer-icon rs-icon-borderstyle rs-toolbar-icon tipsy_enabled_top" title="<?php echo "SVG Stroke Dasharray"; ?>" style="margin-right:10px"></i>
										<input type="text" class="rs-layer-input-field tipsy_enabled_top" style="width:61px" id="css_svgstroke-hover-dasharray" name="css_svgstroke-hover-dasharray" value="" original-title="<?php echo "SVG Stroke Dash Array"; ?>">
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

										<!-- SVG STROKE DASH OFFSET -->
										<i style="transform: rotateZ(90deg);-webkit-transform: rotateZ(90deg);" class="rs-mini-layer-icon eg-icon-arrow-combo rs-toolbar-icon tipsy_enabled_top" title="<?php echo "SVG Stroke Dash Offset"; ?>" style="margin-right:3px"></i>
										<input type="text" class="rs-layer-input-field tipsy_enabled_top" style="width:61px" id="css_svgstroke-hover-dashoffset" name="css_svgstroke-hover-dashoffset" value="" original-title="<?php echo "SVG Stroke Dash Offset"; ?>">

									</span>

									<span id="hover-sub-font" class="rs-layer-toolbar-box" style="display:block">

										<i class="rs-mini-layer-icon rs-icon-color rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Font Color",'revslider'); ?>"></i>
										<input type="text" class="my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("Font Color",'revslider'); ?>"  data-editing="Layer Hover Color" data-mode="single"  id="hover_layer_color_s" name="hover_color_static" value="#ff0000" />
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
										

										<!-- DECORATION -->
										<i class="rs-mini-layer-icon rs-icon-decoration rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Font Decoration"; ?>" style="margin-right:10px"></i>
										<select class="rs-staticcustomstylechange rs-layer-input-field  tipsy_enabled_top" title="<?php echo "Font Decoration"; ?>" style="width:100px;cursor:pointer" id="hover_css_text-decoration" name="hover_css_text-decoration">
											<option value="none"><?php echo 'none' ; ?></option>
											<option value="underline"><?php echo 'underline' ; ?></option>
											<option value="overline"><?php echo 'overline' ; ?></option>
											<option value="line-through"><?php echo 'line-through' ; ?></option>
										</select>
									</span>
									
									<span id="hover-sub-background" class="rs-layer-toolbar-box" style="display:none;border:none;">
										<!-- BACKGROUND COLOR -->
										<i class="rs-mini-layer-icon rs-icon-bg rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Background Color",'revslider'); ?>" style="margin-right:10px"></i>
										<input type="text" class="rs-staticcustomstylechange my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("Background Color",'revslider'); ?>" data-editing="Layer Background Hover Color" id="hover_css_background-color" name="hover_css_background-color" value="transparent" />
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>										
									</span>

										<span id="hover-sub-border" class="rs-layer-toolbar-box" style="display:none;border:none;">
										<!-- BORDER COLOR -->
										<i class="rs-mini-layer-icon rs-icon-bordercolor rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Border Color",'revslider'); ?>" style="margin-right:10px"></i>
										<input type="text" class="rs-staticcustomstylechange my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("Border Color",'revslider'); ?>"  data-editing="Layer Border Hover Color" data-mode="single" id="hover_css_border-color-show" name="hover_css_border-color-show" value="transparent" />


										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

										<!-- BORDER STYLE -->
										<i class="rs-mini-layer-icon rs-icon-borderstyle rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Border Style"; ?>" style="margin-right:10px"></i>
										<select class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Style"; ?>" style="width:100px;cursor:pointer" id="hover_css_border-style" name="hover_css_border-style">
											<option value="none"><?php echo 'none' ; ?></option>
											<option value="dotted"><?php echo 'dotted' ; ?></option>
											<option value="dashed"><?php echo 'dashed' ; ?></option>
											<option value="solid"><?php echo 'solid' ; ?></option>
											<option value="double"><?php echo 'double' ; ?></option>
										</select>
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

										<!-- BORDER WIDTH-->
										<i class="rs-mini-layer-icon rs-icon-borderwidth rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Border Width"; ?>" style="margin-right:10px"></i>
										<input data-suffix="px" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Width"; ?>" style="width:50px" type="text" name="hover_css_border-width[]" value="0">
										<input data-suffix="px" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Width"; ?>" style="width:50px" type="text" name="hover_css_border-width[]" value="0">
										<input data-suffix="px" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Width"; ?>" style="width:50px" type="text" name="hover_css_border-width[]" value="0">
										<input data-suffix="px" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Width"; ?>" style="width:50px" type="text" name="hover_css_border-width[]" value="0">
										<span class="rs-layer-toolbar-space" style="margin-right:16px"></span>

										<!-- BORDER RADIUS -->
										<i class="rs-mini-layer-icon rs-icon-borderradius rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Border Radius (px)"; ?>" style="margin-right:10px"></i>
										<input data-suffix="px" data-steps="1" data-min="0" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Radius Top Left"; ?>" style="width:50px" type="text" name="hover_css_border-radius[]" value="0px">
										<input data-suffix="px" data-steps="1" data-min="0" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Radius Top Right"; ?>" style="width:50px" type="text" name="hover_css_border-radius[]" value="0px">
										<input data-suffix="px" data-steps="1" data-min="0" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Radius Bottom Right"; ?>" style="width:50px" type="text" name="hover_css_border-radius[]" value="0px">
										<input data-suffix="px" data-steps="1" data-min="0" class="rs-staticcustomstylechange corn-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Border Radius Bottom Left"; ?>" style="width:50px" type="text" name="hover_css_border-radius[]" value="0px">
									</span>
									
									<span id="hover-sub-transform" class="rs-layer-toolbar-box" style="display:none;border:none;">
										<!-- OPACITY -->
										<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Opacity. (1 = 100% Visible / 0.5 = 50% opacaity / 0 = transparent)"; ?>" style="margin-right:8px"></i>
										<input data-suffix="" data-steps="0.05" data-min="0" data-max="1" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Opacity (1 = 100% Visible / 0.5 = 50% opacaity / 0 = transparent)"; ?>" id="hover_layer__opacity" name="hover_layer__opacity" value="1">
										<span class="rs-layer-toolbar-space"></span>
										
										<!-- SCALE X -->
										<i class="rs-mini-layer-icon rs-icon-scalex rs-toolbar-icon tipsy_enabled_top" title="<?php echo "X Scale  1 = 100%, 0.5=50%... (+/-)"; ?>" style="margin-right:8px"></i>
										<input data-suffix="" data-steps="0.01" data-min="0" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "X Scale  1 = 100%, 0.5=50%... (+/-)"; ?>" id="hover_layer__scalex" name="hover_layer__scalex" value="1">
										<span class="rs-layer-toolbar-space"></span>
										<!-- SCALE Y -->
										<i class="rs-mini-layer-icon rs-icon-scaley rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Y Scale  1 = 100%, 0.5=50%... (+/-)"; ?>" style="margin-right:4px"></i>
										<input data-suffix="" data-steps="0.01"  data-min="0" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Y Scale  1 = 100%, 0.5=50%... (+/-)"; ?>" id="hover_layer__scaley" name="hover_layer__scaley" value="1">
										<span class="rs-layer-toolbar-space"></span>
										
										<!-- SKEW X -->
										<i class="rs-mini-layer-icon rs-icon-skewx rs-toolbar-icon tipsy_enabled_top" title="<?php echo "X Skew (+/-  px)"; ?>" style="margin-right:8px"></i>
										<input data-suffix="px" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field  tipsy_enabled_top" title="<?php echo "X Skew (+/-  px)"; ?>" id="hover_layer__skewx" name="hover_layer__skewx" value="0">
										<span class="rs-layer-toolbar-space"></span>
										<!-- SKEW Y -->
										<i class="rs-mini-layer-icon rs-icon-skewy rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Y Skew (+/-  px)"; ?>" style="margin-right:4px"></i>
										<input data-suffix="px" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Y Skew (+/-  px)"; ?>" id="hover_layer__skewy" name="hover_layer__skewy" value="0">
									</span>


									<span id="hover-sub-rotation" class="rs-layer-toolbar-box" style="display:none;border:none;">
										<!--  X  ROTATE -->
										<i class="rs-mini-layer-icon rs-icon-rotationx rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Rotation on X axis (+/-)"; ?>"></i>
										<input data-suffix="deg" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Rotation on X axis (+/-)"; ?>" id="hover_layer__xrotate" name="hover_layer__xrotate" value="0">
										<span class="rs-layer-toolbar-space"></span>
										<!--  Y ROTATE -->
										<i class="rs-mini-layer-icon rs-icon-rotationy rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Rotation on Y axis (+/-)"; ?>"></i>
										<input data-suffix="deg" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Rotation on Y axis (+/-)"; ?>" id="hover_layer__yrotate" name="hover_layer__yrotate" value="0">
										<span class="rs-layer-toolbar-space"></span>

										<!--  Z ROTATE -->
										<i class="rs-mini-layer-icon rs-icon-rotationz rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Rotation on Z axis (+/-)"; ?>"></i>
										<input data-suffix="deg" type="text" style="width:50px;" class="rs-staticcustomstylechange textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Rotation on Z axis (+/-)"; ?>" id="hover_layer_2d_rotation" name="hover_layer_2d_rotation" value="0">

									</span>
									
									<!-- ADVANCED CSS -->
									<span id="hover-sub-advcss" class="rs-layer-toolbar-box" style="display:none;border:none;">
										<div id="advanced-css-main" class="rev-advanced-css-hover advanced-copy-button"><?php echo "Template"; ?></div>
										<div id="advanced-css-layer" class="rev-advanced-css-hover-layer advanced-copy-button"><?php echo "Layer"; ?></div>
									</span>
									
							</div>


							<!-- IDLE OR HOVER -->
							<div id="idle-hover-swapper" style="width:83px; z-index:900;position: relative;">
								<span id="toggle-idle-hover" class="idleisselected">
									<span class="advanced-label icon-styleidle"><?php echo "Idle"; ?></span>
									<span class="advanced-label icon-stylehover"><?php echo "Hover"; ?></span>
								</span>
								<div style="width:100%;height:1px; clear:both"></div>
								<div style="margin:10px 0px 0px; text-align: center">
									<div id="copy-idle-css" class="advanced-copy-button copy-settings-trigger clicktoshowmoresub"><?php echo "COPY"; ?><i class="eg-icon-down-open"></i>
										<span class="copy-settings-from clicktoshowmoresub_inner" style="display: none; height:58px;">
											<span class="copy-from-idle css-template-handling-menupoint"><?php echo "Copy From Idle"; ?></span>
											<span class="copy-from-hover css-template-handling-menupoint"><?php echo "Copy From Hover"; ?></span>
											<span class="copy-from-in-anim css-template-handling-menupoint"><?php echo "Copy From In Animation"; ?></span>
											<span class="copy-from-out-anim css-template-handling-menupoint"><?php echo "Copy From Out Animation"; ?></span>
										</span>
									</div>
								</div>
							</div>
							<div style="clear:both; display:block;"></div>
						</div>											
					</div>
				</div>

			</div><!-- LAYER POSITION AND ALIGN TOOLBAR ENDS HERE -->


			<!-- LAYER STYLING -->
			<!--<div class="layer-settings-toolbar" id="rs-hover-content-wrapper" style="display:none">
				<div id="extra_style_settings" class="extra_sub_settings_wrapper" style="margin:0; background:#fff;">
					<div style="width:137px;height:75px;float:left;display:inline-block;border-right:1px solid #ddd;padding: 6px 20px 0px;">
						<div id="advanced-css-hover" class="rev-advanced-css-hover"style="margin-right:0px"><?php echo "Hover CSS"; ?></div>
					</div>
				</div>
			</div><!-- LAYER HOVER STYLES ENDS HERE -->

			<!-- LAYER ANIMATIONS -->
			<div class="layer-settings-toolbar" id="rs-animation-content-wrapper" style="display:none">
				<p style="margin:0; border-bottom:1px solid #ddd">
					<!-- START TRANSITIONS -->
					<span class="rs-layer-toolbar-box startanim_mainwrapper">
						<i class="rs-icon-inanim rs-toolbar-icon" style="z-index:100; position:relative;"></i>
						<span id="startanim_wrapper" style="z-index:50; ">
							<span id="startanim_timerunnerbox"></span>
							<span id="startanim_timerunner"></span>
						</span>
					</span>
					
					<span id="add_customanimation_in" title="<?php _e("Advanced Settings",'revslider'); ?>"><i style="width:40px;height:40px" class="rs-icon-plus-gray"></i></span>

					<span class="rs-layer-toolbar-box" style="">
						<!-- ANIMATION DROP DOWN -->
						<i class="rs-mini-layer-icon rs-icon-transition rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Animation Template",'revslider'); ?>"></i>
						<select class="rs-inoutanimationfield rs-layer-input-field tipsy_enabled_top" title="<?php _e("Animation Template",'revslider'); ?>" style="width:135px !important" id="layer_animation" name="layer_animation">
							<?php
							foreach($startanims as $ahandle => $aname){
								$dis = (in_array($ahandle,array('custom',"v5s","v5","v5e","v4s","v4","v4e","vss","vs","vse","vSFXs","vSFX","vSFXe"))) ? ' disabled="disabled"' : '';
								echo '<option value="'.$ahandle.'"'.$dis.'>'.$aname['handle'].'</option>';
							}
							?>
						</select>
						<span id="animin-template-handling-dd" class="clicktoshowmoresub">
							<span id="animin-template-handling-dd-inner" class="clicktoshowmoresub_inner">
								<span style="background:#ddd !important; padding-left:20px;margin-bottom:5px" class="css-template-handling-menupoint"><span><?php _e("Template Options",'revslider'); ?></span></span>
								<span id="save-current-animin"   	class="save-current-animin css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-save-dark"></i><span><?php _e("Save",'revslider'); ?></span></span>
								<span id="save-as-current-animin"   class="save-as-current-animin css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-save-dark"></i><span><?php _e("Save As",'revslider'); ?></span></span>
								<span id="rename-current-animin" class="rename-current-animin css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-chooser-1"></i><span><?php _e("Rename",'revslider'); ?></span></span>
								<span id="reset-current-animin"  class="reset-current-animin css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-2drotation"></i><span><?php _e("Reset",'revslider'); ?></span></span>
								<span id="delete-current-animin" class="delete-current-animin css-template-handling-menupoint"><i style="background-size:10px 14px;" class="rs-mini-layer-icon rs-toolbar-icon rs-icon-delete"></i><span><?php _e("Delete",'revslider'); ?></span></span>
							</span>
						</span>
						
						<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>
						
						<!-- EASING-->
						<i class="rs-mini-layer-icon rs-icon-easing rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Animation Easing",'revslider'); ?>"></i>
						<select class="rs-inoutanimationfield rs-layer-input-field tipsy_enabled_top" title="<?php _e("Animation Easing",'revslider'); ?>" style="width:135px !important"  id="layer_easing" name="layer_easing">
							<?php
							foreach($easings as $ehandle => $ename){
								echo '<option value="'.$ehandle.'">'.$ename.'</option>';
							}
							?>
						</select>
						<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>
                                                <style>
                                                  .show-on-sfx_in .rev-cpicker-master-wrap {
                                                        width: inherit;
                                                    }
                                                </style>
						<!-- ANIMATION START SPEED -->
						<i class="rs-mini-layer-icon rs-icon-clock rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Animation Speed (in ms)",'revslider'); ?>"></i>
						<input type="text" style="width:60px; padding-right:10px;" class="rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Animation Speed (in ms)",'revslider'); ?>" id="layer_speed" name="layer_speed" value="">
						<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

						<!-- SFX ANIMATION COLOR PICKER -->
						<span class="show-on-sfx_in">
							<i class="rs-mini-layer-icon rs-icon-color rs-toolbar-icon tipsy_enabled_top" title="<?php _e("SFX Color",'revslider'); ?>" style = "float:left !important;"></i>
							<input type="text" class="my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("SFX Color",'revslider'); ?>"  data-editing="SFX Color" data-mode="full"  id="sfx_color_start" name="sfx_color_start" value="#ffffff" />
							<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
						</span>

						<!-- SPLIT TEXT -->
						<i class="hide-on-sfx_in rs-mini-layer-icon rs-icon-splittext rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Split Animaton Text (will not respect Html Markups !)",'revslider'); ?>"></i>
						<select id="layer_split" name="layer_split" class="hide-on-sfx_in rs-inoutanimationfield rs-layer-input-field tipsy_enabled_top" title="<?php _e("Split Animaton Text (will not respect Html Markups !)",'revslider'); ?>" style="width:110px">
							<option value="none" selected="selected"><?php _e("No Split",'revslider'); ?></option>
								<option value="chars"><?php _e("Char Based",'revslider'); ?></option>
								<option value="words"><?php _e("Word Based",'revslider'); ?></option>
								<option value="lines"><?php _e("Line Based",'revslider'); ?></option>
						</select>
						<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

						<!-- SPLIT TEXT DIRECTION -->
						<i class="hide-on-sfx_in rs-mini-layer-icon rs-icon-splittext-direction rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Split Animaton Text Direction",'revslider'); ?>"></i>
						<select id="layer_split_direction" name="layer_split_direction" class="hide-on-sfx_in rs-inoutanimationfield rs-layer-input-field tipsy_enabled_top" title="<?php _e("Split Animaton Text Direction",'revslider'); ?>" style="width:110px">							
								<option value="forward" selected="selected"><?php _e("Forward",'revslider'); ?></option>
								<option value="backward"><?php _e("Backward",'revslider'); ?></option>
								<option value="middletoedge"><?php _e("Middle To Edge",'revslider'); ?></option>
								<option value="edgetomiddle"><?php _e("Edge To Middle",'revslider'); ?></option>
								<option value="random"><?php _e("Random",'revslider'); ?></option>
						</select>
						<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

						<i class="hide-on-sfx_in rs-mini-layer-icon rs-icon-splittext-delay rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Animation Delay between Splitted Elements",'revslider'); ?>"></i>
						<input type="text" style="width:65px; padding-right:10px;" class="hide-on-sfx_in rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Animation Delay between Splitted Elements",'revslider'); ?>" id="layer_splitdelay" name="layer_splitdelay" value="10" disabled="disabled">
						
						<!-- SPECIAL EFFECTS -->
						<span id="sfx_in" style="display:none">
							<input id="sfx_in_effect" name="sfx_in_effect" value="" type="text"/>
						<span>
					</span>
				</p>

				<div id="extra_start_animation_settings" class="hide-on-sfx_in extra_sub_settings_wrapper" style="margin:0; background:#fff; display:none; " >

					<div class="anim-direction-wrapper" style="text-align: center">
							<i class="rs-icon-schin rs-toolbar-icon" style="height:90px"></i>																
					</div>

					<div class="float_left" style="display:inline-block;padding:0px 0px;margin-top: 15px;">
							<div class="inner-settings-wrapper">
								<ul class="rs-layer-animation-settings-tabs">
									<li data-content="#anim-sub-s-offset" class="selected"><?php _e("Offset",'revslider'); ?></li>
									<li data-content="#anim-sub-s-opacity"><?php _e("Opacity",'revslider'); ?></li>
									<li data-content="#anim-sub-s-rotation"><?php _e("Rotation",'revslider'); ?></li>
									<li data-content="#anim-sub-s-scale"><?php _e("Scale",'revslider'); ?></li>
									<li data-content="#anim-sub-s-skew"><?php _e("Skew",'revslider'); ?></li>
									<li data-content="#anim-sub-s-mask"><?php _e("Masking",'revslider'); ?></li>
									<li data-content="#anim-sub-s-filters"><?php _e("Filters",'revslider'); ?></li>
									<li data-content="#anim-sub-s-colors"><?php _e("Colors",'revslider'); ?></li>
									<!--<li data-content="#anim-sub-s-typo"><?php _e("Typo",'revslider'); ?></li>-->
									<!--<li data-content="#anim-sub-s-shadow"><?php _e("Shadow",'revslider'); ?></li>-->
									<!--li data-content="#anim-sub-s-origin"><?php _e("Origin",'revslider'); ?></li-->
									<!--<li data-content="#anim-sub-s-perspective"><?php _e("Perspective",'revslider'); ?></li>-->
								</ul>

								<!-- TYPO -- LETTER SPACING
								<span id="anim-sub-s-typo" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">									
									<i class="rs-mini-layer-icon rs-icon-letterspacing rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Letter Spacing",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																	
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Letter Spacing",'revslider'); ?>"  id="letterspacing_start" name="letterspacing_start" value="0" data-selects="inherit||0||Custom||3||7" data-svalues ="inherit||0||5||3||7" data-icons="export||minus||wrench||shuffle||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>									
								</span>
								-->
                                                                <!-- COLORS IN -->							
								<span id="anim-sub-s-colors" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
									<i class="rs-mini-layer-icon rs-icon-color rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Use Font Color Start",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input type="checkbox" id="use_text_color_start" name="use_text_color_start" class="rs-inoutanimationfield tp-moderncheckbox"/>
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<i class="rs-mini-layer-icon rs-icon-bg rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Use BG Color Start",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input type="checkbox" id="use_bg_color_start" name="use_bg_color_start" class="rs-inoutanimationfield tp-moderncheckbox"/>
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									
									<span class="use_text_color_wrap_start" style="display:none">
										<!-- TEXT COLOR START -->																		
										<i class="rs-mini-layer-icon rs-icon-color rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Font Color Start",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
										<input type="text" class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top my-color-field" title="<?php _e("Text Color From",'revslider'); ?>" style="width:150px" id="text_color_start" name="text_color_start" data-mode="single" value="transparent" />
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									</span>

									<span class="use_bg_color_wrap_start" style="display:none">
										<!-- BG COLOR START -->
										<i class="rs-mini-layer-icon rs-icon-bg rs-toolbar-icon tipsy_enabled_top" title="<?php _e("BG Color Start",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>									
										<input type="text" class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top my-color-field" title="<?php _e("Text Color From",'revslider'); ?>" style="width:150px" id="bg_color_start" name="bg_color_start" data-mode="single" value="transparent" />
										<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									</span>
								</span>
								<!-- FILTERS IN -->							
								<span id="anim-sub-s-filters" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
									<!-- BLUR START -->
									<i class="rs-mini-layer-icon fa-icon-spinner rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Blur",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																	
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Blur",'revslider'); ?>"  id="blurfilter_start" name="blurfilter_start" value="0" data-selects="0||Custom||3||10" data-svalues ="0||5||3||10" data-icons="minus||shuffle||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- grayscale START -->
									<i class="rs-mini-layer-icon fa-icon-adjust rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Grayscale",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																
									<input data-suffix="%" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Grayscale",'revslider'); ?>"  id="grayscalefilter_start" name="grayscalefilter_start" value="0"  data-selects="0||Custom||25%||100%" data-svalues ="0||50||25||100" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- brightness START -->
									<i class="rs-mini-layer-icon fa-icon-adjust rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Brightness",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																
									<input data-suffix="%" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("brightness",'revslider'); ?>"  id="brightnessfilter_start" name="brightnessfilter_start" value="100"  data-selects="100%||Custom||50%||150%" data-svalues ="100||125||50||150" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								</span>

								<!-- SHADOW IN -->							
								<span id="anim-sub-s-shadow" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
									<!-- DROP SHADOW -->								
									<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon " style="margin-right:8px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="ds_x_start" name="ds_x_start" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon " style="margin-right:4px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="ds_y_start" name="ds_y_start" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<i class="rs-mini-layer-icon fa-icon-spinner rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Blur Radius",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Blur Radius",'revslider'); ?>"  id="ds_blur_start" name="ds_blur_start" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									<!--<i class="rs-mini-layer-icon fa-icon-bullseye rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Spread Radius",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Spread Radius",'revslider'); ?>"  id="ds_spread_start" name="ds_spread_start" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>-->
									<!-- SHADOW COLOR START-->								
									<input type="text" class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top my-color-field" title="<?php _e("Shadow Color",'revslider'); ?>" style="width:150px" id="ds_color_start" name="ds_color_start" value="transparent" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

									<!-- SHADOW OPACITY START-->
									<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Shadow Opacity",'revslider'); ?>" style="margin-right:10px"></i>
									<input data-suffix="" data-steps="0.05" data-min="0" data-max="1" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php _e("Shadow Opacity",'revslider'); ?>" style="width:50px" type="text" id="ds_opacity_start" name="ds_opacity_start" value="1">
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
									
								</span>

								<!-- MASKING IN -->							
								<span id="anim-sub-s-mask" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
									<span class="mask-is-available">
										<i class="rs-mini-layer-icon eg-icon-scissors rs-toolbar-icon"></i>
										<input type="checkbox" id="masking-start" name="masking-start" class="rs-inoutanimationfield tp-moderncheckbox"/>
										<span class="rs-layer-toolbar-space"></span>
									</span>
									<span class="mask-not-available">
										<strong><?php _e('Mask is not available due Style Transitions. Please remove any Rotation, Scale or skew effect form Idle and Hover settings', 'revslider'); ?></strong>
									</span>
									<span class="mask-start-settings">
										<!-- MASK X OFFSET -->
										<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon "  style="margin-right:8px"></i>								
										<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="mask_anim_xstart" name="mask_anim_xstart" value="0" data-reverse="on" data-selects="0||Random||Custom||Stage Left||Stage Right||-100%||100%||-175%||175%" data-svalues ="0||{-50,50}||50||stage_left||stage_right||[-100%]||[100%]||[-175%]||[175%]" data-icons="minus||shuffle||wrench||right||left||filter||filter||filter||filter">
										<span class="rs-layer-toolbar-space"></span>
										<!-- MASK Y OFFSET -->
										<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon "  style="margin-right:4px"></i>
										<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="mask_anim_ystart" name="mask_anim_ystart" value="0" data-reverse="on" data-selects="0||Random||Custom||Stage Top||Stage Bottom||-100%||100%||-175%||175%" data-svalues ="0||{-50,50}||50||stage_top||stage_bottom||[-100%]||[100%]||[-175%]||[175%]" data-icons="minus||shuffle||wrench||down||up||filter||filter||filter||filter">
										<span class="rs-layer-toolbar-space"></span>									
									</span>					
								</span>
								

								<span id="anim-sub-s-offset" class="rs-layer-toolbar-box" style="padding-top:0px;border:none;">
									<!-- X OFFSET -->
									<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon "  style="margin-right:8px"></i>								
									<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_anim_xstart" name="layer_anim_xstart" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Stage Left||Stage Right||Stage Center||-100%||100%||-175%||175%||Cycles" data-svalues ="inherit||{-50,50}||50||left||right||center||[-100%]||[100%]||[-175%]||[175%]||[-50|50]" data-icons="export||shuffle||wrench||right||left||cancel||filter||filter||filter||filter||arrow-combo">
									<span class="rs-layer-toolbar-space"></span>
									<!-- Y OFFSET -->
									<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon "  style="margin-right:4px"></i>
									<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_anim_ystart" name="layer_anim_ystart" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Stage Top||Stage Bottom||Stage Middle||-100%||100%||-175%||175%||Cycles" data-svalues ="inherit||{-5,50}||50||top||bottom||middle||[-100%]||[100%]||[-175%]||[175%]||[-50|50]" data-icons="export||shuffle||wrench||down||up||cancel||filter||filter||filter||filter||arrow-combo">
									<span class="rs-layer-toolbar-space"></span>
									<!-- Z OFFSET -->
									<i class="rs-mini-layer-icon rs-icon-zoffset rs-toolbar-icon "  style="margin-right:4px"></i>
									<input type="text" data-suffix="px" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_anim_zstart" name="layer_anim_zstart" value="inherit" id="layer_anim_ystart" name="layer_anim_ystart" value="inherit" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-20,20}||20||[-50|50]" data-icons="export||shuffle||wrench||arrow-combo">
								</span>

								<span id="anim-sub-s-skew" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
									<!-- SKEW X -->
									<i class="rs-mini-layer-icon rs-icon-skewx rs-toolbar-icon "  style="margin-right:8px"></i>
									<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field  "  id="layer_skew_xstart" name="layer_skew_xstart" value="inherit"  value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-25,25}||20||[-25|25|-20|20]" data-icons="export||shuffle||wrench||arrow-combo">
									<span class="rs-layer-toolbar-space"></span>
									<!-- SKEW Y -->
									<i class="rs-mini-layer-icon rs-icon-skewy rs-toolbar-icon "  style="margin-right:8px"></i>
									<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_skew_ystart" name="layer_skew_ystart" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-25,25}||20||[-25|25|-20|20]" data-icons="export||shuffle||wrench||arrow-combo">
								</span>

								
								<span id="anim-sub-s-rotation" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
									<!--  X  ROTATE -->
									<i class="rs-mini-layer-icon rs-icon-rotationx rs-toolbar-icon " ></i>
									<input data-suffix="deg" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_anim_xrotate" name="layer_anim_xrotate" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-90,90}||45||[-50|50]" data-icons="export||shuffle||wrench||arrow-combo">
									<span class="rs-layer-toolbar-space"></span>
									<!--  Y ROTATE -->
									<i class="rs-mini-layer-icon rs-icon-rotationy rs-toolbar-icon " ></i>
									<input data-suffix="deg" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_anim_yrotate" name="layer_anim_yrotate" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-90,90}||45||[-50|50]" data-icons="export||shuffle||wrench||arrow-combo">
									<span class="rs-layer-toolbar-space"></span>
									
									<!--  Z ROTATE -->
									<i class="rs-mini-layer-icon rs-icon-rotationz rs-toolbar-icon " ></i>
									<input data-suffix="deg" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_anim_zrotate" name="layer_anim_zrotate" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-360,360}||45||[-50|50]" data-icons="export||shuffle||wrench||arrow-combo">

								</span>

								<span id="anim-sub-s-scale" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
									<!-- SCALE X -->
									<i class="rs-mini-layer-icon rs-icon-scalex rs-toolbar-icon "  style="margin-right:8px"></i>
									<input data-suffix="" data-steps="0.01" data-min="0" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_scale_xstart" name="layer_scale_xstart" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{0,1}||0.5||[1|2|0.5]" data-icons="export||shuffle||wrench||arrow-combo">
									<span class="rs-layer-toolbar-space"></span>
									<!-- SCALE Y -->
									<i class="rs-mini-layer-icon rs-icon-scaley rs-toolbar-icon " style="margin-right:8px"></i>
									<input data-suffix="" data-steps="0.01" data-min="0" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field " id="layer_scale_ystart" name="layer_scale_ystart" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{0,1}||0.5[1|2|0.5]" data-icons="export||shuffle||wrench||arrow-combo">
								</span>

								<span id="anim-sub-s-opacity" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
									<!-- OPACITY -->
									<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon "  style="margin-right:8px"></i>
									<input data-suffix="" data-steps="0.05" data-min="0" data-max="1" type="text" style="width:100px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field " id="layer_opacity_start" name="layer_opacity_start" value="inherit" data-selects="Inherit||Random||Custom" data-svalues ="inherit||{0,1}||0.5" data-icons="export||shuffle||wrench">
								</span>
							</div>																
					</div>				
					<div style="clear:both; display:block;"></div>


				</div>

				<!-- END TRANSITIONS -->
				<p style="margin:0;">
					<span class="rs-layer-toolbar-box endanim_mainwrapper">
						<i class="rs-icon-outanim rs-toolbar-icon " style="z-index:100; position:relative;"></i>
						<span id="endanim_wrapper" style="z-index:50">
							<span id="endanim_timerunnerbox"></span>
							<span id="endanim_timerunner"></span>
						</span>
					</span>
					
					<span id="add_customanimation_out" title="<?php _e("Advanced Settings",'revslider'); ?>"><i style="width:40px;height:40px" class="rs-icon-plus-gray"></i></span>
					
					<?php
					$endanims = $operations->getArrEndAnimations();
					?>
					<span class="rs-layer-toolbar-box" style="">
						<!-- ANIMATION DROP DOWN -->
						<i class="rs-mini-layer-icon rs-icon-transition rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Animation Template",'revslider'); ?>"></i>
						<select class="rs-inoutanimationfield rs-layer-input-field" style="width:135px !important" id="layer_endanimation" name="layer_endanimation" class=" tipsy_enabled_top" title="<?php _e("Animation Template",'revslider'); ?>">
							<?php
							foreach($endanims as $ahandle => $aname){
								$dis = (in_array($ahandle,array('custom',"v5s","v5","v5e","v4s","v4","v4e","vss","vs","vse","vSFXs","vSFX","vSFXe"))) ? ' disabled="disabled"' : '';
								echo '<option value="'.$ahandle.'"'.$dis.'>'.$aname['handle'].'</option>';
							}
							?>
						</select>
						<span id="animout-template-handling-dd" class="clicktoshowmoresub" style="z-index:901">
							<span id="animout-template-handling-dd-inner" class="clicktoshowmoresub_inner">
								<span style="background:#ddd !important; padding-left:20px;margin-bottom:5px" class="css-template-handling-menupoint"><span><?php _e("Template Options",'revslider'); ?></span></span>
								<span id="save-current-animout"   	class="save-current-animout css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-save-dark"></i><span><?php _e("Save",'revslider'); ?></span></span>
								<span id="save-as-current-animout"   class="save-as-current-animout css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-save-dark"></i><span><?php _e("Save As",'revslider'); ?></span></span>
								<span id="rename-current-animout" class="rename-current-animout css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-chooser-1"></i><span><?php _e("Rename",'revslider'); ?></span></span>
								<span id="reset-current-animout"  class="reset-current-animout css-template-handling-menupoint"><i class="rs-mini-layer-icon rs-toolbar-icon rs-icon-2drotation"></i><span><?php _e("Reset",'revslider'); ?></span></span>
								<span id="delete-current-animout" class="delete-current-animout css-template-handling-menupoint"><i style="background-size:10px 14px;" class="rs-mini-layer-icon rs-toolbar-icon rs-icon-delete"></i><span><?php _e("Delete",'revslider'); ?></span></span>
							</span>
						</span>

						<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>
						<?php
						$easings = $operations->getArrEndEasing();
						?>
						<!-- EASING-->
						<i class="rs-mini-layer-icon rs-icon-easing rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Animation Easing",'revslider'); ?>"></i>
						<select class="rs-inoutanimationfield rs-layer-input-field tipsy_enabled_top" title="<?php _e("Animation Easing",'revslider'); ?>" style="width:135px !important"  id="layer_endeasing" name="layer_endeasing">
							<?php
							foreach($easings as $ehandle => $ename){
								echo '<option value="'.$ehandle.'">'.$ename.'</option>';
							}
							?>
							</select>
							<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

							<!-- ANIMATION END SPEED -->
							<i class="rs-mini-layer-icon rs-icon-clock rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Animation Speed (in ms)",'revslider'); ?>"></i>
							<input type="text" style="width:60px; " class="rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Animation Speed (in ms)",'revslider'); ?>" id="layer_endspeed" name="layer_endspeed" value="">
							<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

							<!-- SFX ANIMATION COLOR PICKER OUT -->
							<span class="show-on-sfx_in">
								<i class="rs-mini-layer-icon rs-icon-color rs-toolbar-icon tipsy_enabled_top" title="<?php _e("SFX Color Out",'revslider'); ?>" style = "float:left !important;"></i>
								<input type="text" class="my-color-field rs-layer-input-field tipsy_enabled_top" title="<?php _e("SFX Color Out",'revslider'); ?>"  data-editing="SFX Color" data-mode="full"  id="sfx_color_end" name="sfx_color_end" value="#ffffff" />
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
							</span>

							<!-- SPLIT TEXT -->
							<i class="hide-on-sfx_out rs-mini-layer-icon rs-icon-splittext rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Split Animaton Text (will not respect Html Markups !)",'revslider'); ?>"></i>
							<select id="layer_endsplit" name="layer_endsplit" class="hide-on-sfx_out rs-inoutanimationfield rs-layer-input-field tipsy_enabled_top" title="<?php _e("Split Animaton Text (will not respect Html Markups !)",'revslider'); ?>" style="width:110px">
								<option value="none" selected="selected"><?php _e("No Split",'revslider'); ?></option>
									<option value="chars"><?php _e("Char Based",'revslider'); ?></option>
									<option value="words"><?php _e("Word Based",'revslider'); ?></option>
									<option value="lines"><?php _e("Line Based",'revslider'); ?></option>
							</select>
							<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

							<!-- SPLIT TEXT DIRECTION -->
							<i class="hide-on-sfx_in rs-mini-layer-icon rs-icon-splittext-direction rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Split Animaton Text Direction",'revslider'); ?>"></i>
							<select id="layer_endsplit_direction" name="layer_endsplit_direction" class="hide-on-sfx_in rs-inoutanimationfield rs-layer-input-field tipsy_enabled_top" title="<?php _e("Split Animaton Text Direction",'revslider'); ?>" style="width:110px">								
									<option value="forward" selected="selected"><?php _e("Forward",'revslider'); ?></option>
									<option value="backward"><?php _e("Backward",'revslider'); ?></option>
									<option value="middletoedge"><?php _e("Middle To Edge",'revslider'); ?></option>
									<option value="edgetomiddle"><?php _e("Edge To Middle",'revslider'); ?></option>
									<option value="random"><?php _e("Random",'revslider'); ?></option>
							</select>
							<span class="rs-layer-toolbar-space" style="margin-right: 10px"></span>

							<i class="hide-on-sfx_out rs-mini-layer-icon rs-icon-splittext-delay rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Animation Delay between Splitted Elements",'revslider'); ?>"></i>
							<input type="text" style="width:65px; " class="hide-on-sfx_out rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Animation Delay between Splitted Elements",'revslider'); ?>" id="layer_endsplitdelay" name="layer_endsplitdelay" value="10" disabled="disabled">

							<!-- SPECIAL EFFECTS -->
							<span id="sfx_out" style="display:none">
								<input id="sfx_out_effect" name="sfx_out_effect" value="" type="text"/>
							<span>
					</span>
				</p>
				<div id="extra_end_animation_settings" class="hide-on-sfx_out extra_sub_settings_wrapper" style="margin:0; background:#fff; display:none;">
					<div class="anim-direction-wrapper" style="text-align: center">
							<i class="rs-icon-schout rs-toolbar-icon" style="height:90px"></i>																
					</div>


					<div class="float_left" style="display:inline-block;padding:0px 0px; margin-top: 15px;">
						<div class="inner-settings-wrapper" >
							<ul class="rs-layer-animation-settings-tabs" style="margin-left: 0px;">
								<li data-content="#anim-sub-e-offset" class="selected"><?php _e("Offset",'revslider'); ?></li>
								<li data-content="#anim-sub-e-opacity"><?php _e("Opacity",'revslider'); ?></li>
								<li data-content="#anim-sub-e-rotation"><?php _e("Rotation",'revslider'); ?></li>
								<li data-content="#anim-sub-e-scale"><?php _e("Scale",'revslider'); ?></li>
								<li data-content="#anim-sub-e-skew"><?php _e("Skew",'revslider'); ?></li>
								<li data-content="#anim-sub-e-mask"><?php _e("Masking",'revslider'); ?></li>
								<li data-content="#anim-sub-e-filters"><?php _e("Filters",'revslider'); ?></li>
								<!--<li data-content="#anim-sub-e-typo"><?php _e("Typo",'revslider'); ?></li>-->
								<!--<li data-content="#anim-sub-e-shadow"><?php _e("Shadow",'revslider'); ?></li>-->
								<!--li data-content="#anim-sub-e-origin"><?php _e("Origin",'revslider'); ?></li-->
								<!--<li data-content="#anim-sub-e-perspective"><?php _e("Perspective",'revslider'); ?></li>-->
							</ul>


							<!-- TYPO OUT
							<span id="anim-sub-e-typo" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">									
								<i class="rs-mini-layer-icon rs-icon-letterspacing rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Letter Spacing",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																	
								<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Letter Spacing",'revslider'); ?>"  id="letterspacing_end" name="letterspacing_end" value="0" data-selects="inherit||0||Custom||3||7" data-svalues ="inherit||0||5||3||7" data-icons="export||minus||wrench||shuffle||filter||filter">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>									
							</span>-->

                                                        <!-- COLORS IN -->							
							<span id="anim-sub-e-colors" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
								<i class="rs-mini-layer-icon rs-icon-color rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Use Font Color End",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
								<input type="checkbox" id="use_text_color_end" name="use_text_color_end" class="rs-inoutanimationfield tp-moderncheckbox"/>
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

								<i class="rs-mini-layer-icon rs-icon-bg rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Use BG Color End",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
								<input type="checkbox" id="use_bg_color_end" name="use_bg_color_end" class="rs-inoutanimationfield tp-moderncheckbox"/>
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								
								<span class="use_text_color_wrap_end" style="display:none">
									<!-- TEXT COLOR end -->																		
									<i class="rs-mini-layer-icon rs-icon-color rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Font Color End",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
									<input type="text" class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top my-color-field" title="<?php _e("Text Color From",'revslider'); ?>" style="width:150px" id="text_color_end" name="text_color_end" data-mode="single" value="transparent" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								</span>

								<span class="use_bg_color_wrap_end" style="display:none">
									<!-- BG COLOR end -->
									<i class="rs-mini-layer-icon rs-icon-bg rs-toolbar-icon tipsy_enabled_top" title="<?php _e("BG Color End",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>									
									<input type="text" class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top my-color-field" title="<?php _e("Text Color From",'revslider'); ?>" style="width:150px" id="bg_color_end" name="bg_color_end" data-mode="single" value="transparent" />
									<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								</span>
							</span>
							<!-- FILTERS OUT -->							
								<span id="anim-sub-e-filters" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
								<!-- BLUR End -->
								<i class="rs-mini-layer-icon fa-icon-spinner rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Blur",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																	
								<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Blur",'revslider'); ?>"  id="blurfilter_end" name="blurfilter_end" value="0" data-selects="0||Custom||3||10||0" data-svalues ="0||5||3||10" data-icons="minus||shuffle||wrench||filter||filter">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

								<!-- grayscale End -->
								<i class="rs-mini-layer-icon fa-icon-adjust rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Grayscale",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																
								<input data-suffix="%" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Grayscale",'revslider'); ?>"  id="grayscalefilter_end" name="grayscalefilter_end" value="0"  data-selects="0||Custom||25||100" data-svalues ="0||50||25||100" data-icons="minus||wrench||filter||filter">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

								<!-- brightness END -->
								<i class="rs-mini-layer-icon fa-icon-adjust rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Brightness",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>																
								<input data-suffix="%" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Brightness",'revslider'); ?>"  id="brightnessfilter_end" name="brightnessfilter_end" value="100"  data-selects="100%||Custom||50%||150%" data-svalues ="100||125||50||150" data-icons="minus||wrench||filter||filter">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
							</span>

							<!-- SHADOW OUT -->							
							<span id="anim-sub-e-shadow" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
								<!-- DROP SHADOW -->								
								<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon " style="margin-right:8px"></i>
								<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="ds_x_end" name="ds_x_end" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon " style="margin-right:4px"></i>
								<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="ds_y_end" name="ds_y_end" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								<i class="rs-mini-layer-icon fa-icon-spinner rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Blur Radius",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
								<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Blur Radius",'revslider'); ?>"  id="ds_blur_end" name="ds_blur_end" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								<!--<i class="rs-mini-layer-icon fa-icon-bullseye rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Spread Radius",'revslider'); ?>"  style="margin-right:8px;font-size:20px;line-height:26px"></i>
								<input data-suffix="px" type="text" style="width:105px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php _e("Spread Radius",'revslider'); ?>"  id="ds_spread_end" name="ds_spread_end" value="0"  data-selects="0||Custom||10||20" data-svalues ="0||5||10||20" data-icons="minus||wrench||filter||filter">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>-->
								<!-- SHADOW COLOR START-->								
								<input type="text" class="rs-staticcustomstylechange rs-layer-input-field tipsy_enabled_top my-color-field" title="<?php _e("Shadow Color",'revslider'); ?>" style="width:150px" id="ds_color_end" name="ds_color_end" value="transparent" />
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>

								<!-- SHADOW OPACITY START-->
								<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon tipsy_enabled_top" title="<?php _e("Shadow Opacity",'revslider'); ?>" style="margin-right:10px"></i>
								<input data-suffix="" data-steps="0.05" data-min="0" data-max="1" class="rs-staticcustomstylechange pad-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php _e("Shadow Opacity",'revslider'); ?>" style="width:50px" type="text" id="ds_opacity_end" name="ds_opacity_end" value="1">
								<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>
								
							</span>




							<!-- MASKING IN -->							
							<span id="anim-sub-e-mask" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
								<span class="mask-is-available">
									<i class="rs-mini-layer-icon eg-icon-scissors rs-toolbar-icon"></i>
									<input type="checkbox" id="masking-end" name="masking-end" class="rs-inoutanimationfield tp-moderncheckbox"/>
									<span class="rs-layer-toolbar-space"></span>
								</span>
								<span class="mask-not-available">
									<strong><?php _e('Mask is not available due Style Transitions. Please remove any Rotation, Scale or skew effect form Idle and Hover settings' ,'revslider'); ?></strong>
								</span>
								<span class="mask-end-settings">
									<!-- MASK X OFFSET -->
									<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon "  style="margin-right:8px"></i>								
									<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="mask_anim_xend" name="mask_anim_xend" value="0" data-reverse="on" data-selects="Inherit||Random||Custom||Stage Left||Stage Right||Stage Center||-100%||100%||-175%||175%" data-svalues ="inherit||{-50,50}||50||left||right||center||[-100%]||[100%]||[-175%]||[175%]" data-icons="export||shuffle||wrench||right||left||cancel||filter||filter||filter||filter">
									<span class="rs-layer-toolbar-space"></span>
									<!-- MASK Y OFFSET -->
									<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon "  style="margin-right:4px"></i>
									<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="mask_anim_yend" name="mask_anim_yend" value="0" data-reverse="on" data-selects="Inherit||Random||Custom||Stage Top||Stage Bottom||Stage Middle||-100%||100%||-175%||175%" data-svalues ="inherit||{-50,50}||50||top||bottom||middle||[-100%]||[100%]||[-175%]||[175%]" data-icons="export||shuffle||wrench||down||up||cancel||filter||filter||filter||filter">
									<span class="rs-layer-toolbar-space"></span>
								</span>					
							</span>


							<span id="anim-sub-e-offset" class="rs-layer-toolbar-box" style="padding-top:0px;border:none;">
								<!-- X OFFSET END-->
								<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon"  style="margin-right:8px"></i>								
								<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field"  id="layer_anim_xend" name="layer_anim_xend" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Stage Left||Stage Right||Stage Center||-100%||100%||-175%||175%||Cycles" data-svalues ="inherit||{-50,50}||50||left||right||center||[-100%]||[100%]||[-175%]||[175%]||[-100|100]" data-icons="export||shuffle||wrench||right||left||cancel||filter||filter||filter||filter||arrow-combo">
								<span class="rs-layer-toolbar-space"></span>
								<!-- Y OFFSET END-->
								<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon"  style="margin-right:4px"></i>
								<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field"  id="layer_anim_yend" name="layer_anim_yend" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Stage Top||Stage Bottom||Stage Middle||-100%||100%||-175%||175%||Cycles" data-svalues ="inherit||{-50,50}||50||top||bottom||middle||[-100%]||[100%]||[-175%]||[175%]||[-100|100]" data-icons="export||shuffle||wrench||down||up||cancel||filter||filter||filter||filter||arrow-combo">
								<span class="rs-layer-toolbar-space"></span>
								<!-- Z OFFSET END-->
								<i class="rs-mini-layer-icon rs-icon-zoffset rs-toolbar-icon"  style="margin-right:4px"></i>
								<input type="text" data-suffix="px" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field"  id="layer_anim_zend" name="layer_anim_zend" value="inherit" value="0" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-20,20}||20||[-100|100]" data-icons="export||shuffle||wrench||arrow-combo">
							</span>


							<span id="anim-sub-e-skew" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
								<!-- SKEW X -->
								<i class="rs-mini-layer-icon rs-icon-skewx rs-toolbar-icon"  style="margin-right:8px"></i>
								<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_skew_xend" name="layer_skew_xend" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-25,25}||20||[--25|25]" data-icons="export||shuffle||wrench||arrow-combo">
								<span class="rs-layer-toolbar-space"></span>
								<!-- SKEW Y -->
								<i class="rs-mini-layer-icon rs-icon-skewy rs-toolbar-icon"  style="margin-right:8px"></i>
								<input data-suffix="px" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field"  id="layer_skew_yend" name="layer_skew_yend" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-25,25}||20||[-25|25]" data-icons="export||shuffle||wrench||arrow-combo">
							</span>

				
							<span id="anim-sub-e-rotation" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
								<!--  X  ROTATE -->
								<i class="rs-mini-layer-icon rs-icon-rotationx rs-toolbar-icon" ></i>
								<input data-suffix="deg" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field"  id="layer_anim_xrotate_end" name="layer_anim_xrotate_end" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-90,90}||45||[-75|75]" data-icons="export||shuffle||wrench||arrow-combo">
								<span class="rs-layer-toolbar-space"></span>
								<!--  Y ROTATE END -->
								<i class="rs-mini-layer-icon rs-icon-rotationy rs-toolbar-icon" ></i>
								<input data-suffix="deg" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field"  id="layer_anim_yrotate_end" name="layer_anim_yrotate_end" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-90,90}||45||[-75|75]" data-icons="export||shuffle||wrench||arrow-combo">
								<span class="rs-layer-toolbar-space"></span>
								
								<!--  Z ROTATE END -->
								<i class="rs-mini-layer-icon rs-icon-rotationz rs-toolbar-icon" ></i>
								<input data-suffix="deg" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field"  id="layer_anim_zrotate_end" name="layer_anim_zrotate_end" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{-360,360}||45||[-75|75]" data-icons="export||shuffle||wrench||arrow-combo">
							</span>

							<span id="anim-sub-e-scale" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
								<!-- SCALE X -->
								<i class="rs-mini-layer-icon rs-icon-scalex rs-toolbar-icon "  style="margin-right:8px"></i>
								<input data-suffix="" data-steps="0.01" data-min="0" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field "  id="layer_scale_xend" name="layer_scale_xend" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{0,1}||0.5||[0.5|2]" data-icons="export||shuffle||wrench||arrow-combo">
								<span class="rs-layer-toolbar-space"></span>
								<!-- SCALE Y -->
								<i class="rs-mini-layer-icon rs-icon-scaley rs-toolbar-icon " style="margin-right:8px"></i>
								<input data-suffix="" data-steps="0.01" data-min="0" type="text" style="width:175px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field " id="layer_scale_yend" name="layer_scale_yend" value="inherit" data-reverse="on" data-selects="Inherit||Random||Custom||Cycles" data-svalues ="inherit||{0,1}||0.5||[0.5|2]" data-icons="export||shuffle||wrench||arrow-combo">
							</span>

							<span id="anim-sub-e-opacity" class="rs-layer-toolbar-box" style="padding-top:0px;display:none;border:none;">
								<!-- OPACITY -->
								<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon "  style="margin-right:8px"></i>
								<input data-suffix="" data-steps="0.05" data-min="0" data-max="1" type="text" style="width:100px;" class="input-deepselects rs-inoutanimationfield textbox-caption rs-layer-input-field " id="layer_opacity_end" name="layer_opacity_end" value="inherit" data-selects="Inherit||Random||Custom" data-svalues ="inherit||{0,1}||0.5" data-icons="export||shuffle||wrench">
							</span>

						

						</div>					
					</div>
					<div style="clear:both; display:block;"></div>

				</div>

			</div>

                        
                        
			<!-- LOOP ANIMATIONS -->
			<div class="layer-settings-toolbar" id="rs-loop-content-wrapper" style="display: none">
				<div class="topdddborder">
					<span class="rs-layer-toolbar-box" style="padding-right:26px">
						<span><?php echo "Loop"; ?></span>
					</span>

					<span class="rs-layer-toolbar-box" style="">
						<i class="rs-mini-layer-icon rs-icon-transition rs-toolbar-icon"></i>
						<select class="rs-loopanimationfield rs-layer-input-field" style="width:110px" id="layer_loop_animation" name="layer_loop_animation" class="">
							<option value="none" selected="selected"><?php echo 'Disabled'; ?></option>
							<option value="rs-pendulum"><?php echo 'Pendulum'; ?></option>
							<option value="rs-rotate"><?php echo 'Rotate'; ?></option>
							<option value="rs-slideloop"><?php echo 'Slideloop'; ?></option>
							<option value="rs-pulse"><?php echo 'Pulse'; ?></option>
							<option value="rs-wave"><?php echo 'Wave'; ?></option>
						</select>
					</span>

					<!-- ANIMATION END SPEED -->
					<span id="layer_speed_wrapper" class="rs-layer-toolbar-box tipsy_enabled_top" title="<?php echo "Loop Speed (sec) - 0.3 = 300ms"; ?>" style="display:none">
						<i class="rs-mini-layer-icon rs-icon-clock rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Loop Speed (ms)"; ?>"></i>
						<input type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field" id="layer_loop_speed" name="layer_loop_speed" value="2">
						<span class="rs-layer-toolbar-space"></span>
					</span>
					<?php
					$easings = $operations->getArrEasing();
					?>
					
					<!-- EASING-->
					<span id="layer_easing_wrapper" class="rs-layer-toolbar-box tipsy_enabled_top" title="<?php echo "Loop Easing"; ?>" style="display:none">
						<i class="rs-mini-layer-icon rs-icon-easing rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Loop Easing"; ?>"></i>
						<select class="rs-loopanimationfield  rs-layer-input-field" style="width:175px"  id="layer_loop_easing" name="layer_loop_easing">
							<?php
							foreach($easings as $ehandle => $ename){
								echo '<option value="'.$ehandle.'">'.$ename.'</option>';
							}
							?>
						</select>
					</span>
				</div>
				<div>
					<!-- LOOP PARAMETERS -->
					<span class="rs-layer-toolbar-box" style="padding-right:18px; display:none;" id="layer_parameters_wrapper">
						<span><?php echo "Loop Parameters"; ?></span>
					</span>

					<!-- ROTATION PART -->
					<span id="layer_degree_wrapper" class="rs-layer-toolbar-box" style="display:none">
						<!-- ROTATION START -->
						<i class="rs-mini-layer-icon rs-icon-rotation-start rs-toolbar-icon tipsy_enabled_top" title="<?php echo "2D Rotation start deg."; ?>"></i>
						<input data-suffix="deg" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "2D Rotation start deg."; ?>" id="layer_loop_startdeg" name="layer_loop_startdeg" value="-20">
						<span class="rs-layer-toolbar-space"></span>
						<!-- ROTATION END -->
						<i class="rs-mini-layer-icon rs-icon-rotation-end rs-toolbar-icon tipsy_enabled_top" title="<?php echo "2D Rotation end deg."; ?>"></i>
						<input data-suffix="deg" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "2D Rotation end deg."; ?>" id="layer_loop_enddeg" name="layer_loop_enddeg" value="20">
					</span>
					<!-- ORIGIN -->
					<span id="layer_origin_wrapper" class="rs-layer-toolbar-box" style="display:none">
						<!-- ORIGIN X -->
						<i class="rs-mini-layer-icon rs-icon-originx rs-toolbar-icon tipsy_enabled_top" title="<?php echo "2D Rotation X Origin"; ?>"></i>
						<input data-suffix="%" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "2D Rotation X Origin"; ?>" id="layer_loop_xorigin" name="layer_loop_xorigin" value="50">
						<span class="rs-layer-toolbar-space"></span>
						<!-- ORIGIN Y -->
						<i class="rs-mini-layer-icon rs-icon-originy rs-toolbar-icon tipsy_enabled_top" title="<?php echo "2D Rotation Y Origin"; ?>"></i>
						<input data-suffix="%" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "2D Rotation Y Origin"; ?>" id="layer_loop_yorigin" name="layer_loop_yorigin" value="50">
					</span>
					<!-- X/Y START -->
					<span id="layer_x_wrapper" class="rs-layer-toolbar-box" style="display:none">
						<span><?php echo "Start"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Start X Offset"; ?>" style="margin-right:8px"></i>
						<input data-suffix="px" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Start X Offset"; ?>" id="layer_loop_xstart" name="layer_loop_xstart" value="0">
						<span class="rs-layer-toolbar-space"></span>
						<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon tipsy_enabled_top" title="<?php echo "Start Y Offset"; ?>" style="margin-right:4px"></i>
						<input data-suffix="px" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Start Y Offset"; ?>" id="layer_loop_ystart" name="layer_loop_ystart" value="0">
					</span>
					<!-- X/Y END -->
					<span id="layer_y_wrapper" class="rs-layer-toolbar-box" style="display:none">
						<span><?php echo "End"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<i class="rs-mini-layer-icon rs-icon-xoffset rs-toolbar-icon tipsy_enabled_top" title="<?php echo "End X Offset"; ?>" style="margin-right:8px"></i>
						<input data-suffix="px" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "End X Offset"; ?>" id="layer_loop_xend" name="layer_loop_xend" value="0">
						<span class="rs-layer-toolbar-space"></span>
						<i class="rs-mini-layer-icon rs-icon-yoffset rs-toolbar-icon tipsy_enabled_top" title="<?php echo "End Y Offset"; ?>" style="margin-right:4px"></i>
						<input data-suffix="px" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "End Y Offset"; ?>" id="layer_loop_yend" name="layer_loop_yend" value="0">
					</span>

					<!-- ZOOM -->
					<span id="layer_zoom_wrapper" class="rs-layer-toolbar-box" style="display:none">
						<span><?php echo "Zoom Start"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Zoom Start"; ?>" id="layer_loop_zoomstart" name="layer_loop_zoomstart" value="1">
						<span class="rs-layer-toolbar-space"></span>
						<span><?php echo "Zoom End"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Zoom End"; ?>" id="layer_loop_zoomend" name="layer_loop_zoomend" value="1">
					</span>
					<!-- ANGLE -->
					<span id="layer_angle_wrapper" class="rs-layer-toolbar-box" style="display:none">
						<span><?php echo "Angle"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Start Angle"; ?>" id="layer_loop_angle" name="layer_loop_angle" value="0">
					</span>
					<!-- RADIUS -->
					<span id="layer_radius_wrapper" class="rs-layer-toolbar-box" style="display:none">
						<span><?php echo "Radius"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input data-suffix="px" type="text" style="width:90px;" class="rs-loopanimationfield  textbox-caption rs-layer-input-field tipsy_enabled_top" title="<?php echo "Radius of Rotation / Pendulum"; ?>" id="layer_loop_radius" name="layer_loop_radius" value="10">
					</span>
				</div>
			</div>

			<!-- LINK SETTINGS -->
			<div class="layer-settings-toolbar" id="rs-parallax-content-wrapper" style="display:none;">
				<?php 
					if ($use_parallax=="off") {	
						echo '<span class="rs-layer-toolbar-box">';
						echo '<span class="rs-layer-toolbar-space"></span>';
						echo '<i style="color:#c0392b">';
						echo "Parallax Feature in Slider Settings is deactivated, parallax will be ignored."; 
						echo '</i>';
						echo '</span>'; 
					} else {  ?>
					
						<!-- PARALLAX LEVEL -->
						<span class="rs-layer-toolbar-box">
								<?php 
									$ddd_label_text="Parallax Depth";
									$ddd_no_parallax="No Parallax";
									if ($parallaxisddd!="off") { 
										$ddd_label_text="3D Depth";
										$ddd_no_parallax="Default 3D Depth";
										
									}
								?>
								<span><?php echo $ddd_label_text; ?></span>

								<span class="rs-layer-toolbar-space"></span>
								<select class="rs-layer-input-field" style="width:149px" id="parallax_level" name="parallax_level">																								
									<option value="-"><?php echo $ddd_no_parallax; ?></option>
									<option value="1">1 - (<?php echo $parallax_level[0]; ?>%)</option>
									<option value="2">2  - (<?php echo $parallax_level[1]; ?>%)</option>
									<option value="3">3  - (<?php echo $parallax_level[2]; ?>%)</option>
									<option value="4">4  - (<?php echo $parallax_level[3]; ?>%)</option>
									<option value="5">5  - (<?php echo $parallax_level[4]; ?>%)</option>
									<option value="6">6  - (<?php echo $parallax_level[5]; ?>%)</option>
									<option value="7">7  - (<?php echo $parallax_level[6]; ?>%)</option>
									<option value="8">8  - (<?php echo $parallax_level[7]; ?>%)</option>
									<option value="9">9  - (<?php echo $parallax_level[8]; ?>%)</option>
									<option value="10">10  - (<?php echo $parallax_level[9]; ?>%)</option>
									<option value="11">11  - (<?php echo $parallax_level[10]; ?>%)</option>
									<option value="12">12  - (<?php echo $parallax_level[11]; ?>%)</option>
									<option value="13">13  - (<?php echo $parallax_level[12]; ?>%)</option>
									<option value="14">14  - (<?php echo $parallax_level[13]; ?>%)</option>
									<option value="15">15  - (<?php echo $parallax_level[14]; ?>%)</option>
								</select>
						</span>
						<?php 
						if ($parallaxisddd!="off") { 
						?>
							<!-- CLASSES -->
							<span class="rs-layer-toolbar-box" id="put_layer_ddd_to_z">
								<span><?php echo "Attach to"; ?></span>
								<span class="rs-layer-toolbar-space"></span>
								<select class="rs-layer-input-field" style="width:149px" id="parallax_layer_ddd_zlevel" name="parallax_layer_ddd_zlevel">									
										<option value="layers"><?php echo 'Layers 3D Group'; ?></option>							
										<option value="bg"><?php echo 'Background 3D Group'; ?></option>	
									</select>
							</span>
						<?php
						}				
					}
				?>						
			</div>
			<script>			
				jQuery('#parallax_level').on("change",function() {				
					var sbi = jQuery(this),
						v = sbi.find('option:selected').val();
					if (v=="-")				
						jQuery('#put_layer_ddd_to_z').show();				
					else
						jQuery('#put_layer_ddd_to_z').hide();				
				});
				jQuery('#parallax_level').change();			
			</script>
			
			
			
			<!-- ADDON SETTINGS -->
			<div class="layer-settings-toolbar" id="rs-addon-wrapper" style="display:none;">
				<div id="rs-addon-wrapper-button-row">
					<span class="rs-layer-toolbar-box"><?php echo 'Select Add-on'; ?></span>
					<?php 
                                     
					if(!empty($slider_addons)){
						foreach($slider_addons as $rs_addon_handle => $rs_addon){
							?>
							<span class="rs-layer-toolbar-box">
								<span id="rs-addon-trigger-<?php echo $rs_addon_handle; ?>" class="rs-addon-trigger"><?php echo $rs_addon['title']; ?></span>
							</span>
							<?php
						}
					?>
				</div>
				
				<div style="border-top:1px solid #ddd;">
					<?php 
						foreach($slider_addons as $rs_addon_handle => $rs_addon){
							?>
							<div id="rs-addon-trigger-<?php echo $rs_addon_handle; ?>-settings" class="rs-addon-settings-wrapper" style="display: none;">
								<?php echo $rs_addon['markup']; ?>
								<script type="text/javascript">
									<?php echo $rs_addon['javascript']; ?>
								</script>
							</div>
							<?php
						}
						?>
						<script type="text/javascript">
							jQuery('.rs-addon-trigger').click(function(){
								var show_addon = jQuery(this).attr('id');
								jQuery('.rs-addon-trigger').removeClass("selected");
								jQuery(this).addClass("selected");
								jQuery('.rs-addon-settings-wrapper').hide();
								jQuery('#'+show_addon+'-settings').show();
							});
						</script>
						<?php
					}
					?>
				</div>
			</div>
			
			<!-- LINK SETTINGS -->
			<div class="layer-settings-toolbar" id="rs-action-content-wrapper" style="display:none">		

				<div style="padding:5px 20px 5px">
					
					<span id="triggered-element-behavior">
						<span class="rs-layer-toolbar-box">
							<span><?php echo "Animation Timing"; ?></span>
							<span class="rs-layer-toolbar-space"></span>
							<select id="layer-animation-overwrite" name="layer-animation-overwrite" class="rs-layer-input-field" style="width:300px">
								<option value="default" selected="selected"><?php echo "In and Out Animation Default"; ?></option>							
								<option value="waitout"><?php echo "In Animation Default and Out Animation Wait for Trigger"; ?></option>
								<option value="wait"><?php echo "Wait for Trigger"; ?></option>
							</select>
						</span>
						<span class="rs-layer-toolbar-box">
							<span><?php echo "Trigger Memory"; ?></span>
							<span class="rs-layer-toolbar-space"></span>
							<select id="layer-tigger-memory" name="layer-tigger-memory" class="rs-layer-input-field" style="width:300px">
								<option value="reset" selected="selected"><?php echo "Reset Animation and Trigger States every loop"; ?></option>
								<option value="keep"><?php echo "Keep last selected State"; ?></option>
								
							</select>
						</span>
					</span>	

					<ul class="layer_action_table">
						
						<!-- actions will be added here -->
						
						
						<li class="layer_action_row layer_action_add_template">
							<div class="add-action-row">
								<i class="eg-icon-plus"></i>
							</div>
						</li>
					</ul>

					<script>
						jQuery(document).ready(function() {
							jQuery('body').on('click','.remove-action-row',function() {
								UniteLayersRev.remove_action(jQuery(this));
							});
							
							jQuery('.add-action-row').click(function(){
								UniteLayersRev.add_layer_actions();
							});
						});

					</script>
				</div>
			
			</div>

			<!-- ATTRIBUTE SETTINGS -->
			<div class="layer-settings-toolbar" id="rs-attribute-content-wrapper" style="display:none;">
				<div class="topdddborder">
					
					<!-- ID -->
					<span class="rs-layer-toolbar-box">
						<span><?php echo "ID"; ?></span>
						<span class="rs-layer-toolbar-space" style="margin-right:11px"></span>
						<input type="text" style="width:105px;" class="textbox-caption rs-layer-input-field" id="layer_id" name="layer_id" value="">
					</span>
					
									
					<!-- CLASSES -->
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Classes"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:105px;" class="textbox-caption rs-layer-input-field" id="layer_classes" name="layer_classes" value="">
					</span>

					<!-- WRAPPER ID -->
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Wrapper ID"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:105px;" class="textbox-caption rs-layer-input-field" id="layer_wrapper_id" name="layer_wrapper_id" value="">
					</span>
					
					<!-- WRAPPER CLASSES -->
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Wrapper Classes"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:105px;" class="textbox-caption rs-layer-input-field" id="layer_wrapper_classes" name="layer_wrapper_classes" value="">
					</span>

					<!-- INTERNAL CLASSES -->
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Internal Classes:"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<?php 
						//ONLY FOR DEBUG!!
						?>
						<!-- input type="text" style="width:105px;" class="textbox-caption rs-layer-input-field" id="internal_classes" name="internal_classes" value="" -->
						<input type="hidden" style="width:105px;" class="textbox-caption rs-layer-input-field" id="internal_classes" name="internal_classes" value="">
						<span class="rs-internal-class-wrapper"></span>
						<span class="rs-layer-toolbar-space"></span>
					</span>

				</div>
				<div>
					<!-- REL -->
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Rel"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:105px;" class="textbox-caption rs-layer-input-field" id="layer_rel" name="layer_rel" value="">					
					</span>

					<!-- TITLE -->
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Title"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:105px;" class="textbox-caption rs-layer-input-field" id="layer_title" name="layer_title" value="">
					</span>

					<!-- TABINDEX -->
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Tabindex"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="text" style="width:105px;" class="textbox-caption rs-layer-input-field" id="layer_tabindex" name="layer_tabindex" value="">
					</span>
					
					<!-- ALT -->
					<span id="layer_alt_row" class="rs-layer-toolbar-box">
						<span><?php echo "Alt"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<select id="layer_alt_option" name="layer_alt_option" class="rs-layer-input-field" style="width:100px">
							<option value="media_library"><?php echo 'From Media Library'; ?></option>
							<option value="file_name"><?php echo 'From Filename'; ?></option>
							<option value="custom"><?php echo 'Custom'; ?></option>
						</select>
						<input type="text" style="display: none; width:105px;" class="textbox-caption rs-layer-input-field" id="layer_alt" name="layer_alt" value="">
					</span>
					
					
					
					
					<?php 
					//ONLY FOR DEBUG!!
					?>
					<!-- LAYER TYPE -->
					<!--span class="rs-layer-toolbar-box">
						<span><?php echo "Layer Type:"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<select name="layer_type" id="layer_type">
							<option value="text">text</option>
							<option value="video">video</option>
							<option value="button">button</option>
							<option value="shape">shape</option>
							<option value="image">image</option>
						</select>
						<span class="rs-layer-toolbar-space"></span>
					</span-->
					
				</div>
			</div>


			<!-- VISIBILITY SETTINGS -->
			<div class="layer-settings-toolbar" id="rs-visibility-content-wrapper" style="display:none">
				<div class="topdddborder">
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Visibility on Devices"; ?></span>
					</span>
					<span class="rs-layer-toolbar-box">
						<span class="rev-visibility-on-sizes">
							<i class="rs-mini-layer-icon rs-icon-desktop rs-toolbar-icon"></i>
							<input type="checkbox" id="visible-desktop" name="visible-desktop" class="tp-moderncheckbox"/>
							<span class="rs-layer-toolbar-space"></span>

							<i class="rs-mini-layer-icon rs-icon-laptop rs-toolbar-icon"></i>
							<input type="checkbox" id="visible-notebook" name="visible-notebook" class="tp-moderncheckbox"/>
							<span class="rs-layer-toolbar-space"></span>

							<i class="rs-mini-layer-icon rs-icon-tablet rs-toolbar-icon"></i>
							<input type="checkbox" id="visible-tablet" name="visible-tablet" class="tp-moderncheckbox"/>
							<span class="rs-layer-toolbar-space"></span>

							<i class="rs-mini-layer-icon rs-icon-phone rs-toolbar-icon"></i>
							<input type="checkbox" id="visible-mobile" name="visible-mobile" class="tp-moderncheckbox"/>
						</span>
					</span>
					
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Hide 'Under' Width"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="checkbox" id="layer_hidden" class="tp-moderncheckbox" name="layer_hidden">
					</span>
					
					<span class="rs-layer-toolbar-box">
						<span><?php echo "Only on Slider Hover"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<input type="checkbox" id="layer_on_slider_hover" class="tp-moderncheckbox" name="layer_on_slider_hover">
					</span>
				</div>
			</div>

			<!-- BEHAVIOR SETTINGS -->
			<div class="layer-settings-toolbar" id="rs-behavior-content-wrapper" style="display:none">
				<div class="topdddborder">
						
					<span class="rs-layer-toolbar-box ho_column_ ho_row_">
						<span><?php echo "Auto Responsive"; ?></span>
						<span class="rs-layer-toolbar-space" style="margin-right:18px"></span>
						<input type="checkbox" id="layer_resize-full" class="tp-moderncheckbox" name="layer_resize-full" checked="checked">
					</span>

					<span class="rs-layer-toolbar-box ho_row_ ho_column_ ho_group_">
						<span><?php echo "Child Elements Responsive"; ?></span>
						<span class="rs-layer-toolbar-space" style="margin-right:18px"></span>
						<input type="checkbox" id="layer_resizeme" class="tp-moderncheckbox" name="layer_resizeme" checked="checked">
					</span>

					<span class="rs-layer-toolbar-box">
						<span><?php echo "Align"; ?></span>
						<span class="rs-layer-toolbar-space" style="margin-right:18px"></span>
							<select id="layer_align_base" name="layer_align_base" class="rs-layer-input-field" style="width:100px">
								<option value="grid" selected="selected"><?php echo "Grid Based"; ?></option>
								<option value="slide"><?php echo "Slide Based"; ?></option>							
							</select>
					</span>

					<span class="rs-layer-toolbar-box">
						<span><?php echo "Responsive Offset"; ?></span>
						<span class="rs-layer-toolbar-space" style="margin-right:18px"></span>
						<input type="checkbox" id="layer_resp_offset" class="tp-moderncheckbox" name="layer_resp_offset" checked="checked">
					</span>
					
					<span class="rs-layer-toolbar-box" style="display:none">
						<span><?php echo "Position"; ?></span>
						<span class="rs-layer-toolbar-space"></span>
						<select id="layer-css-position" name="layer-css-position" class="rs-layer-input-field" style="width:150px">
							<option value="absolute" selected="selected"><?php echo "absoolue"; ?></option>
							<option value="relative"><?php echo "relative"; ?></option>
						</select>
					</span>
				</div>
				
				<span class="rs-layer-toolbar-box rs-lazy-load-images-wrap">
					<span><?php echo "Lazy Loading"; ?></span>
					<span class="rs-layer-toolbar-space"></span>
					<select id="layer-lazy-loading" name="layer-lazy-loading" class="rs-layer-input-field" style="width:150px">
						<option value="auto" selected="selected"><?php echo "Default Setting"; ?></option>
						<option value="force"><?php echo "Force Lazy Loading"; ?></option>
						<option value="ignore"><?php echo "Ignore Lazy Loading"; ?></option>
					</select>
				</span>
				<span class="rs-layer-toolbar-box rs-lazy-load-images-wrap">
					<span><?php echo "Source Type"; ?></span>
					<span class="rs-layer-toolbar-space"></span>
					<select id="layer-image-size" name="layer-image-size" class="rs-layer-input-field" style="width:150px">
						<option value="auto" selected="selected"><?php echo "Default Setting"; ?></option>
						<?php
						foreach($img_sizes as $imghandle => $imgSize){
							echo '<option value="'.$imghandle.'">'.$imgSize.'</option>';
						}
						?>
					</select>
				</span>
				
				
			</div>


			<!-- STATIC LAYERS SETTINGS -->
			<div class="layer-settings-toolbar" id="rs-static-content-wrapper" style="display:none">
				<?php
					$show_static = 'display: none;';
					if($slide->isStaticSlide())
						$show_static = '';
					$isTemplate = $slider->getParam("template", "false");

				if($isTemplate == "true"){
				?>
					<span class="rs-layer-toolbar-box">
						<?php echo 'Static Layers will be shown on every slide in template sliders'; ?>
					</span>
				<?php }
				?>

				<span class="rs-layer-toolbar-box" id="layer_static_wrapper" <?php echo ($isTemplate == "true") ? ' style="display: none;"' : ''; ?>>

					<span><?php echo "Start on Slide"; ?></span>
					<span class="rs-layer-toolbar-space"></span>
					<select id="layer_static_start" name="static_start">
						<?php
						if(!empty($arrSlideNames)){
							$si = 1;
							end($arrSlideNames);
							//fetch key of the last element of the array.
							$lastElementKey = key($arrSlideNames);
							foreach($arrSlideNames as $sid => $sparams){
								if($lastElementKey == $sid && count($arrSlideNames) > 1) break; //break on the last element
								?>
								<option value="<?php echo $si; ?>"><?php echo $si; ?></option>
								<?php
								$si++;
							}
							/*?><option value="last"><?php echo 'Last Slide'; ?></option><?php*/
						}else{
							?>
							<option value="-1">-1</option>
							<?php
						}
						?>
					</select>
					<span class="rs-layer-toolbar-space"></span>
					<span><?php echo "End on Slide"; ?></span>
					<span class="rs-layer-toolbar-space"></span>
					<select id="layer_static_end" name="static_end">
						<?php
						if(!empty($arrSlideNames)){
							$si = 1;
							foreach($arrSlideNames as $sid => $sparams){
								?>
								<option value="<?php echo $si; ?>"><?php echo $si; ?></option>
								<?php
								$si++;
							}
							/*?><option value="last"><?php echo 'Last Slide'; ?></option><?php*/
						}else{
							?>
							<option value="-1">-1</option>
							<?php
						}
						?>
					</select>
				</span>
			</div>
		</form>
		<!-- END OF AMAZING TOOLBAR -->	

		<div id="top-toolbar-wrapper">
			<!--div id="rs-undo-redo-wrapper" style="position: relative;">
				<a href="javascript:void(0);" id="rs-undo-handler"><i class="eg-icon-reply-1"></i></a>
				<a href="javascript:void(0);" id="rs-redo-handler"><i class="eg-icon-forward-1"></i></a>
				<ul id="rs-undo-list" style="display: none; position: absolute; background-color: #FFF; padding: 10px;">
				
				</ul>
				<ul id="rs-redo-list" style="display: none; position: absolute; background-color: #FFF; padding: 10px;">
				
				</ul>
			</div-->
			
			<div id="object_library_call_wrapper">
				<a href="javascript:void(0)" id="button_add_object_layer" class=""><i class="fa-icon-book"></i><span class="add-layer-txt"><?php echo "Object Library"?></span></a>
			</div>


			<div id="add-layer-selector-container">
				
				<a href="javascript:void(0)" id="button_add_any_layer" class="add-layer-button-any tipsy_enabled_top"><i class="rs-icon-addlayer2"></i><span class="add-layer-txt"><?php echo "Add Layer"?></span></a>
				<div id="add-new-layer-container-wrapper">
					<div id="add-new-layer-container">
                                            <?php $add_static ='add-layer-button';?>
						<a href="javascript:void(0)" id="button_add_layer" data-isstatic="<?php echo $add_static; ?>" class="add-layer-button" ><i class="rs-icon-layerfont_n"></i><span class="add-layer-txt"><?php echo "Text/Html"?></span></a>
						<a href="javascript:void(0)" id="button_add_layer_image" data-isstatic="<?php echo $add_static; ?>" class="add-layer-button" ><i class="rs-icon-layerimage_n"></i><span class="add-layer-txt"><?php echo "Image"?></span></a>
						<a href="javascript:void(0)" id="button_add_layer_audio" data-isstatic="<?php echo $add_static; ?>" class="add-layer-button" ><i class="rs-icon-layeraudio_n"></i><span class="add-layer-txt"><?php echo "Audio"?></span></a>
						<a href="javascript:void(0)" id="button_add_layer_video" data-isstatic="<?php echo $add_static; ?>" class="add-layer-button" ><i class="rs-icon-layervideo_n"></i><span class="add-layer-txt"><?php echo "Video"?></span></a>
						<a href="javascript:void(0)" id="button_add_layer_button" data-isstatic="<?php echo $add_static; ?>" class="add-layer-button" ><i class="rs-icon-layerbutton_n"></i><span class="add-layer-txt"><?php echo "Button"?></span></a>
						<a href="javascript:void(0)" id="button_add_layer_shape" data-isstatic="<?php echo $add_static; ?>" class="add-layer-button" ><i class="rs-icon-layershape_n"></i><span class="add-layer-txt"><?php echo "Shape"?></span></a>						
						<a href="javascript:void(0)" id="button_add_layer_svg" data-isstatic="<?php echo $add_static; ?>" class="add-layer-button" ><i class="rs-icon-layersvg_n"></i><span class="add-layer-txt"><?php echo "Object"?></span></a>
						<a href="javascript:void(0)" id="button_add_layer_import" data-isstatic="<?php echo $add_static; ?>" class="add-layer-button" ><i class="eg-icon-download"></i><span class="add-layer-txt"><?php echo "Import"?></span></a>
					</div>
				</div>
			</div>

			<!-- DESKTOP / TABLET / PHONE SIZING -->
			<?php 
			$_width = $slider->getParam('width', 1240);
			$_width_notebook = $slider->getParam('width_notebook', 1024);
			$_width_tablet = $slider->getParam('width_tablet', 778);
			$_width_mobile = $slider->getParam('width_mobile', 480);

			$_height = $slider->getParam('height', 868);
			$_height_notebook = $slider->getParam('height_notebook', 768);
			$_height_tablet = $slider->getParam('height_tablet', 960);
			$_height_mobile = $slider->getParam('height_mobile', 720);

			if($adv_resp_sizes === true){
				?>				
				<span id="rs-edit-layers-on-btn">
					<div data-val="desktop" class="rs-slide-device_selector rs-slide-ds-desktop selected"></div>
					<?php if($enable_custom_size_notebook == 'on'){ ?><div data-val="notebook" class="rs-slide-device_selector rs-slide-ds-notebook"></div><?php } ?>
					<?php if($enable_custom_size_tablet == 'on'){ ?><div data-val="tablet" class="rs-slide-device_selector rs-slide-ds-tablet"></div><?php } ?>
					<?php if($enable_custom_size_iphone == 'on'){ ?><div data-val="mobile" class="rs-slide-device_selector rs-slide-ds-mobile"></div><?php } ?>
				</span>
				
				<div id="rs-set-style-on-devices">
					<span id="rs-set-style-on-devices-button"></span>
					<div id="rs-set-style-on-devices-dialog">
						<label style="font-size:14px; color:#fff; margin-bottom:10px; display:block;"><?php echo "Force Inherit Styles"; ?></label>
						<div class="rs-set-style-on-device-row">
							<label style="width: 100px"><?php echo "Color"; ?></label>
							<input type="checkbox" id="on_all_devices_color" name="on_all_devices_color" class="rs-set-device-chk tp-moderncheckbox"  />
						</div>
						<div class="rs-set-style-on-device-row">
							<label style="width: 100px"><?php echo "Font Size"; ?></label>
							<input type="checkbox" id="on_all_devices_fontsize" name="on_all_devices_fontsize" class="rs-set-device-chk tp-moderncheckbox"  />
						</div>
						<div class="rs-set-style-on-device-row">
							<label style="width: 100px"><?php _e("Letter Spacing",'revslider'); ?></label>
							<input type="checkbox" id="on_all_devices_letterspacing" name="on_all_devices_letterspacing" class="rs-set-device-chk tp-moderncheckbox"  />
						</div>
						<div class="rs-set-style-on-device-row">
							<label style="width: 100px"><?php echo "Font Weight"; ?></label>
							<input type="checkbox" id="on_all_devices_fontweight" name="on_all_devices_fontweight" class="rs-set-device-chk tp-moderncheckbox"  />
						</div>
					</div>
				</div>
				<script type="text/javascript">
					jQuery('#rs-set-style-on-devices-button').click(function(){
						jQuery('#rs-set-style-on-devices-dialog').toggle();
						jQuery(this).toggleClass('selected');						
					});
				</script>
				<?php
			}
			
			?>

			<div id="quick-layer-selector-container">
				<div class="current-active-main-toolbar">
					<div id="layer-short-toolbar" class="layer-toolbar-li">							
						<span id="button_show_all_layer" class="layer-short-tool revdarkgray"><i class="eg-icon-menu"></i>
							<input class="nolayerselectednow" type="text" id="the_current-editing-layer-title"  disabled name="the_current-editing-layer-title" value="No Layer Selected">
						</span>
						
						<span style="display:none;" id="button_change_video_settings" class="layer-short-tool revblue"><i class="eg-icon-pencil"></i></span>		
						<span id="layer-short-tool-placeholder-a" class="layer-short-tool revdarkgray"></span>
						<span id="layer-short-tool-placeholder-b" class="layer-short-tool revdarkgray"></span>					
						<span style="display:none" id="button_edit_layer" class="layer-short-tool revblue"><i class="eg-icon-pencil"></i></span>
						
						<span style="display:none;" id="button_change_image_source" class="layer-short-tool revblue"><i class="eg-icon-pencil"></i></span>		
						
						<span style="display:none" id="button_reset_size" class="layer-short-tool revblue"><i class="eg-icon-resize-normal"></i></span>				
						<span id="button_delete_layer" class="ho_column_ layer-short-tool revred"><i class="rs-lighttrash"></i></span>
						<span id="button_duplicate_layer" class="ho_column_ layer-short-tool revyellow" data-isstatic="<?php echo $add_static; ?>"><i class="rs-lightcopy"></i></span>				
						<span style="display:none;"  id="tp-addiconbutton" class="layer-short-tool revblue"><i class="eg-icon-th"></i></span>
						<?php //if($slider_type != 'gallery'){ ?>
							<span id="linkInsertTemplate"  style="display:none" class="layer-short-tool revyellow"><i class="eg-icon-filter"></i></span>					
						<?php // } ?>
						<span style="display:none" id="hide_layer_content_editor"  class="layer-short-tool revgreen" ><i class="eg-icon-check"></i></span>					
						<span class="quick-layer-view layer-short-tool revdarkgray"><i class="eg-icon-eye"></i></span>
						<span class="quick-layer-lock layer-short-tool revdarkgray"><i class="eg-icon-lock-open"></i></span>										
						<div style="clear:both;display:block"></div>
					</div>
				</div>
				<div id="quick-layers-wrapper" style="display:none">				
					<div id="quick-layers">	

						<div class="tp-clearfix"></div>
						<ul class="quick-layers-list" id="quick-layers-list-id">
							<li id="nolayersavailable" class="nolayersavailable"><div class="add-layer-button"><?php echo "Slide contains no layers"?></div></li>
						</ul>
						<!--<div style="text-align:center; display:block; padding:0px 10px;">
							<span class="gototimeline">Animation Timeline</span>
							</div>-->
					</div>
				</div>
				<!-- TEXT / IMAGE INPUT FIELD CONTENT -->
				<!--<form name="form_layers" class="form_layers">-->
					<div id="layer_text_holder">
						<div id="layer_text_wrapper" style="display:none">
							<span class="toggle_text_title"><?php echo "Untoggled Content"?></span>
							<div class="layer_text_wrapper_inner">
								<div class="layer_text_wrapper_header">					
									<span style="display:none; font-weight:600;" class="layer-content-title-b"><?php echo "Image Layer Title "; ?><span style="margin-left:5px;font-size:11px; font-style: italic;"><?php echo "(only for internal usage):"; ?></span> </span>					
								</div>
								<textarea id="layer_text" class="area-layer-params" name="layer_text" ></textarea>
							</div>
							<span class="toggle_text_title"><?php echo "Toggled Content"?></span>
							<div class="layer_text_wrapper_inner toggled_text_wrapper">

								<textarea id="layer_text_toggle" class="area-layer-params" name="layer_text_toggle" ></textarea>
							</div>
						</div>
					</div>
					
				<!--</form>-->
				<script>
					jQuery('#button_show_all_layer i, #button_show_all_layer').click(function() {

						var camt = jQuery('.current-active-main-toolbar'),
							t = jQuery('#button_show_all_layer'),
							b = jQuery(this);

						if (b.hasClass("eg-icon-up") || b.hasClass("eg-icon-menu") || jQuery('#the_current-editing-layer-title').hasClass("nolayerselectednow")) {
							if (camt.hasClass("opened")) {
								jQuery('#quick-layers-wrapper').slideUp(300);
								camt.removeClass("opened");
								t.find('i').removeClass("eg-icon-up").addClass("eg-icon-menu");
							} else {
								jQuery('#quick-layers-wrapper').slideDown(300);
								camt.addClass("opened");
								t.find('i').addClass("eg-icon-up").removeClass("eg-icon-menu");
								jQuery('#quick-layers-list-id').perfectScrollbar("update");
								
								// KRIKI
								jQuery('#layer_text_wrapper').hide();
								jQuery('#layer_text_wrapper').removeClass('currently_editing_txt');
								UniteLayersRev.showHideContentEditor(false);
								
							}
						} 
						return false;
					})
				</script>
			</div>
		</div>	
	</div><!-- END OF NLS-WRAPPER-->
	<div id="nls-wrapper-fake" style="margin-bottom: 0px;"></div>
	<?php
	$slidertype = $slider->getParam("slider_type","fullwidth");
	$style .= ' margin: 0 auto;';
	$tempwidth_jq = $maxbgwidth;

	if($slidertype == 'fullwidth' || $slidertype == 'fullscreen'){

		$style_wrapper .= ' width: 100%;';
		$maxbgwidth ="";
	} else {
		$style_wrapper .= $style;
	}

	$hor_lines = RevSliderFunctions::getVal($settings, "hor_lines","");
	$ver_lines = RevSliderFunctions::getVal($settings, "ver_lines","");
        
 	?>
	<script>
		var __slidertype  = "<?php echo $slidertype; ?>";
	</script>
	
	<div id="thelayer-editor-wrapper" class="context_menu_trigger">

		<!-- THE EDITOR PART -->
		<div id="horlinie"><div id="horlinetext">0</div></div>
		<div id="verlinie"><div id="verlinetext">0</div></div>
		<div id="hor-css-linear">
			<ul class="linear-texts"></ul>
			<div class="helplines-offsetcontainer">
				<?php
				if(!empty($hor_lines)){
					foreach($hor_lines as $lines){
						?>
						<div class="helplines" style="position:absolute;width:1px;background:#4AFFFF;left:<?php echo $lines; ?>;top:0px"><i class="helpline-drag eg-icon-move"></i><i class="helpline-remove eg-icon-cancel"></i></div>
						<?php
					}
				}
				?>
			</div>
		</div>
		<div id="ver-css-linear">
			<ul class="linear-texts"></ul>
			<div class="helplines-offsetcontainer">
				<?php
				if(!empty($ver_lines)){
					foreach($ver_lines as $lines){
						?>
						<div class="helplines" style="position:absolute;height:1px;background:#4AFFFF;top:<?php echo $lines; ?>;left:0px"><i class="helpline-drag eg-icon-move"></i><i class="helpline-remove eg-icon-cancel"></i></div>
						<?php
					}
				}
				?>
			</div>
		</div>

		<div id="hor-css-linear-cover-left"></div>
		<div id="hor-css-linear-cover-right"></div>
		<div id="ver-css-linear-cover"></div>
		


		<div id="divLayers-wrapper" style="overflow: hidden;<?php echo $style.$maxbgwidth; ?>" class="slide_wrap_layers" >
			<div id="divbgholder" style="<?php echo $style_wrapper.$divbgminwidth.$maxbgwidth ?>" class="<?php echo $class_wrapper; ?>">
				<div class="oldslotholder" style="overflow:hidden;width:100%;height:100%;position:absolute;top:0px;left:0px;z-index:0;">
					<div class="tp-bgimg defaultimg"></div>
				</div>
				<div class="slotholder" style="overflow:hidden;width:100%;height:100%;position:absolute;top:0px;left:0px;z-index:1">
					<div class="tp-bgimg defaultimg" style="width: 100%;height: 100%;position: absolute;top:0px;left:0px; <?php echo $style_wrapper.$divbgminwidth.$maxbgwidth ?>"></div>
				</div>				
				<div id="divLayers" class="<?php echo $divLayersClass?>" style="<?php echo $style.$divLayersWidth; ?>">
					<div id="focusongroup"></div>
					<div class="slide_layers_border bg_context_listener"></div>
					<div class="row-zone-container bg_context_listener" id="row-zone-top"></div>
					<div class="row-zone-container bg_context_listener" id="row-zone-middle"></div>
					<div class="row-zone-container bg_context_listener" id="row-zone-bottom"></div>
				</div>
			</div>			
		</div>

		<!-- Row Layout Composer -->
		<div id="rs-layout-row-composer">
			<div id="rs-layout-row-picker">
				<div id="rowlayout1" class="rowlayout-single" data-comp="1"></div>
				<div id="rowlayout2" class="rowlayout-single" data-comp="1/2 + 1/2"></div>
				<div id="rowlayout3" class="rowlayout-single" data-comp="1/3 + 1/3 + 1/3"></div>
				<div id="rowlayout4" class="rowlayout-single" data-comp="1/4 + 1/4 + 1/4 + 1/4"></div>
				<div id="rowlayout5" class="rowlayout-single" data-comp="1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6"></div>
				<div id="rowlayout6" class="rowlayout-single" data-comp="1/4 + 1/2 + 1/4"></div>
				<div id="rowlayout7" class="rowlayout-single" data-comp="1/6 + 2/3 + 1/6"></div>
				<div id="rowlayout8" class="rowlayout-single" data-comp="2/3 + 1/3"></div>
				<div id="rowlayout9" class="rowlayout-single" data-comp="3/4 + 1/4"></div>
			</div>
			<div id="rs-layout-row-custom">
				<input type="text" placeholder="<?php echo 'Enter Custom Layout. e.g.:1/2 + 1/2'; ?>" id="rs-row-layout" name="rs-row-layout"> <div id="rs-check-row-layout" href="javascript:void(0);"><?php echo 'Update'; ?></div> 
			</div>
			<div id="rs-layout-row-break">
				<span class="setting_text_3"><?php echo 'Break Columns at:'; ?></span>
				<span id="rs-row-break-on-btn">						
					<div data-val="notebook" class="rs-row-break-selector rs-slide-ds-notebook"></div>					
					<div data-val="tablet" class="rs-row-break-selector rs-slide-ds-tablet"></div>					
					<div data-val="mobile" class="rs-row-break-selector rs-slide-ds-mobile"></div>				
				</span>

			</div>
			<script>
				jQuery('.rowlayout-single').click(function() {
					jQuery('#rs-row-layout').val(jQuery(this).data('comp'));
					jQuery('#rs-check-row-layout').click();
				})
			</script>
		</div>		

		

		
		


		<!-- ADD LAYERS, REMOVE LAYERS, DUPLICATE LAYERS -->
		<div id="layer-settings-toolbar-bottom" class="layer-settings-toolbar-bottom">
		<span style="display:inline-block;line-height:50px;vertical-align: middle; ">
			<span class="setting_text_3"><?php echo "Change History:"; ?></span>	
		</span>
		<div id="quick-undo">
			<span id="showhide_undolist" class="layer-short-tool revdarkgray">
				<i class="eg-icon-menu"></i>
			</span>
			<span class="single-undo-action" data-origtext="<?php echo "No More Steps"?>">
				<span class="undo-name"><?php echo "No Changes Recorder"?></span>
				<span class="undo-action"></span>
			</span>
			<span id="undo-last-action">
				<i class="eg-icon-cw"></i>
			</span>
		</div>
			
		

		<!--<a href="javascript:void(0)" id="button_delete_all"      class="button-primary  revred button-disabled"><i class="revicon-trash"></i><?php echo "Delete All Layers"?> </a>-->
		



			<select style="display:none" name="rs-edit-layers-on" id="rs-edit-layers-on">
				<option value="desktop"><?php echo 'Desktop'; ?></option>
				<option value="notebook"><?php echo 'Notebook'; ?></option>
				<option value="tablet"><?php echo 'Tablet'; ?></option>
				<option value="mobile"><?php echo 'Mobile'; ?></option>
			</select>
			<script type="text/javascript">
				

				jQuery('#add-layer-selector-container').hover(function() {
					jQuery('#add-new-layer-container-wrapper').show();
				},function() {
					jQuery('#add-new-layer-container-wrapper').hide();
				});

				
			

				jQuery('#add-layer-minimiser').click(function() {
					var t = jQuery(this);
					if (t.hasClass("closed")) {
						t.removeClass("closed");
						punchgs.TweenLite.to(jQuery('#add-layer-selector-container'),0.4,{autoAlpha:1,rotationY:0,transformOrigin:"0% 50%",ease:punchgs.Power3.easeInOut});
						punchgs.TweenLite.to(jQuery('#quick-layer-selector-container'),0.4,{autoAlpha:1,rotationY:0,transformOrigin:"0% 50%",ease:punchgs.Power3.easeInOut});
					} else {
						t.addClass("closed");
						punchgs.TweenLite.to(jQuery('#add-layer-selector-container'),0.4,{autoAlpha:0,rotationY:-90,transformOrigin:"0% 50%",ease:punchgs.Power3.easeInOut});
						punchgs.TweenLite.to(jQuery('#quick-layer-selector-container'),0.4,{autoAlpha:0,rotationY:-90,transformOrigin:"0% 50%",ease:punchgs.Power3.easeInOut});
					}
					return false;
				});

				

				

				jQuery('#add-new-layer-container a').click(function() {
					jQuery('#add-new-layer-container-wrapper').hide();
					return true;
				});

				<?php
				if($adv_resp_sizes === true){
					?>
					var rev_adv_resp_sizes = true;
					var rev_sizes = {
						'desktop': [<?php echo $_width.', '.$_height; ?>],
						'notebook': [<?php echo $_width_notebook.', '.$_height_notebook; ?>],
						'tablet': [<?php echo $_width_tablet.', '.$_height_tablet; ?>],
						'mobile': [<?php echo $_width_mobile.', '.$_height_mobile; ?>]
					};

					<?php
				}else{
					?>
					var rev_adv_resp_sizes = false;
					<?php
				}
				?>


			</script>

			<!-- HELPER GRID ON/OFF -->
			<span style="float:right;display:inline-block;line-height:50px;vertical-align: middle; margin-right:30px;">
				<span class="setting_text_3"><?php echo "Helper Grid:"; ?></span>
				<select name="rs-grid-sizes" id="rs-grid-sizes">
					<option value="1"><?php echo "Disabled"; ?></option>
					<option value="10">10 x 10</option>
					<option value="25">25 x 25</option>
					<option value="50">50 x 50</option>
					<option value="custom"><?php echo 'Custom'; ?></option>
				</select>
				<span class="rs-layer-toolbar-space" style="margin-right:20px"></span>
				<span class="setting_text_3"><?php echo "Snap to:"; ?></span>
				<select name="rs-grid-snapto" id="rs-grid-snapto" >
					<option value=""><?php echo "None"; ?></option>
					<option value=".helplines"><?php echo "Help Lines"; ?></option>
					<option value=".slide_layer"><?php echo "Layers"; ?></option>
				</select>
			</span>
		</div>

		<div id="timline-manual-dialog" style="display:none">			
			<!-- ANIMATION  TIME AND DURATION -->
			<span style="min-width:370px">
				<label><?php echo "Frame Start"; ?></label>						
				<input type="text" style="width:90px;" class="textbox-caption rs-layer-input-field" id="clayer_start_time" name="clayer_start_time" value="0">
				<span class="over-ms">ms</span>			
				<span class="rs-layer-toolbar-space" style="margin-right:20px"></span>
				<label style="margin-left:10px"><?php echo "Duration"; ?></label>						
				<input type="text" style="width:90px;" class="textbox-caption rs-layer-input-field" id="clayer_start_speed" name="clayer_start_speed" value="0">
				<span class="over-ms">ms</span>
			</span>			
			<span id="timline-manual-closer"><i class="eg-icon-cancel"></i></span>
			<span id="timline-manual-apply"><i class="eg-icon-ok"></i></span>
		</div>
	</div>



	<!-- THE CURRENT TIMER FOR LAYER -->
	<div id="mtw-wrapper">
		<div id="mastertimer-wrapper" class="layer_sortbox">
				


				<div id="master-selectedlayer-t"></div>
				<div id="master-selectedlayer-b"></div>
				<div class="master-leftcell">
					<div id="master-leftheader">
						<div id="mastertimer-playpause-wrapper">
								<i class="eg-icon-play"></i>
								<span><?php echo 'PLAY'; ?></span>
						</div>
						<div id="mastertimer-backtoidle">
						</div>

						<div id="master-timer-time">00:00.00</div>
					</div>
					<div id="v_lw_le" class="layers-wrapper">
						<div class="layers-wrapper-scroll">
							<div id="layers-left" class="sortlist">
								<div class="mastertimer-slide-border"></div>
								<ul id="layers-left-ul" class="mjs-nestedSortable-branch">
									<li id="slide_in_sort" class="mastertimer-layer mastertimer-slide ui-state-default" style="overflow: visible !important; z-index: 100; position: relative">
										<span class="list-of-layer-links multiple-selector tipsy_enabled_top" original-title="Select Multiple Layers">														
											<span class="list-of-layer-links-inner">				
												<input id="timing-all-onoff-checkbox" name="timing-all-onoff-checkbox" type="checkbox"></input>												
												<span data-linktype="1" class="timing-layer-link-type-element layer-link-type-1"></span>				
												<span data-linktype="2" class="timing-layer-link-type-element layer-link-type-2"></span>				
												<span data-linktype="3" class="timing-layer-link-type-element layer-link-type-3"></span>				
												<span data-linktype="4" class="timing-layer-link-type-element layer-link-type-4"></span>				
												<span data-linktype="5" class="timing-layer-link-type-element layer-link-type-5"></span>				
												<span data-linktype="0" class="timing-layer-link-type-element layer-link-type-0"></span>			
											</span>		
										</span>
										<div id="fake-select-title-wrapper">											
											<span id="fake-select-i" class="timeline-title-line mastertimer-timeline-selector-row">
												<i style="vertical-align:top; font-size:14px;margin-left:0px;margin-right:0px;" class="eg-icon-cog"></i>
											</span>
											<span id="fake-select-title"><?php echo 'Slide Main Background'; ?></span>
											<!--<span id="fake-select-label"><?php echo 'Animation'; ?></span>-->
										</div>
									</li>
									<li id="last_drop_zone_layers"></li>
								</ul>								
								<!--<div class="bottom-layers-divider"></div>-->
							</div>
						</div>						
					</div>
				</div>

				<div class="master-rightcell">
					<div id="linear-bg-fixer"></div>
					<div id="master-rightheader">
						
						<div id="mastertimer-position" class="timerinidle"><span id="mastertimer-poscurtime"><?php echo 'DragMe'; ?></span></div>
						<div id="mastertimer-maxtime"><span id="mastertimer-maxcurtime"></span></div>
						<div id="mastertimer-curtime"><span id="mastertimer-curtimeinner"></span></div>
					
						<div id="mastertimer-idlezone"></div>


						<div class="mastertimer">

							<div id="mastertimer-linear">
								<ul  class="linear-texts">

								</ul>								
							</div>
						</div>
					</div>

					<div class="layers-wrapper" id="layers-wrapper-right-wrapper">
						<div id="mastertimer-curtime-b"></div>
						<div class="layers-wrapper-scroll">
							<div id="layers-right">
								<div class="mastertimer-slide-border"></div>
								<ul style="border-bottom: 5px solid #d5d5d5;" id="layers-right-ul">									
									<li id="slide_in_sort_time" class="mastertimer-layer mastertimer-slide ui-state-default">
										<div class="timeline_full"><span id="fake_layer_as_slide_title"><span id="fake-select-pre"><?php echo "Slide BG Animation"; ?></span><span id="fake-select-label"><?php echo 'Animation'; ?></span></span></div>
										<div class="timeline">
											<div data-frameindex="0" class="timeline_frame">
												<span class="timebefore_cont"></span>
												<div class="tl_speed_wrapper">
													<div class="tlf_speed"><span class="duration_cont"></span></div>													
												</div>
											</div>											
										</div>
										<div class="slide-idle-section"></div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div id="timing-helper">
					<div id="whiteblock_extrawrapper">
						<div id="add_new_group"><i class="fa-icon-object-group"></i><span><?php echo 'ADD GROUP'; ?></span></div>
						<?php if($slide->isStaticSlide()){ } else {?>
							<div id="add_new_row"><i class="eg-icon-folder"></i><span><?php echo 'ADD ROW'; ?></span></div>
						<?php } ?>

						<label id="abs_rel_label"><?php echo 'Show Frame Times:'; ?></label>
						<select name="abs_rel_timeline" id="abs_rel_timeline" class="rs-layer-input-field">
							<option value="absolute"><?php echo 'ABSOLUTE'; ?></option>
							<option value="relative"><?php echo 'RELATIVE'; ?></option>
						</select>
					</div>


					

					<div class="timing-all-checker-wrapper">
						<div class="timing-all-checker"></div>
					</div>
					
				</div>
				<div id="mastertimer-wrapper-resizer"></div>
		</div>
	</div>
	<div id="tp-thelistofclasses"></div>
	<div id="tp-thelistoffonts"></div>
	
	<?php
	$obj_library->write_markup();
	?>
	
	<!-- THE BUTTON DIALOG WINDOW -->
	<div id="dialog_addbutton" class="dialog-addbutton" title="<?php echo "Add Button Layer"; ?>" style="display:none">
		<div class="addbuton-dialog-inner">
			<div id="addbutton-examples">
				<div class="addbe-title-row">					
					<span class="addbutton-bg-light"></span>
					<span class="addbutton-bg-dark"></span>
					<span class="addbutton-title" style="font-size:14px;"><?php echo "Click on Element to add it"; ?></span>
				</div>
				
				<div class="addbutton-examples-wrapper">
					<span class="addbutton-title"><?php echo "Buttons"; ?></span>
					<div class="addbutton-buttonrow" style="padding-top: 10px;">
						<a data-needclass="rev-btn" class="rev-btn rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
						<a data-needclass="rev-btn" class="rev-btn rev-medium rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
						<a data-needclass="rev-btn" class="rev-btn rev-small rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
					</div>
					<div class="addbutton-buttonrow">
						<a data-needclass="rev-btn" class="rev-btn rev-minround rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
						<a data-needclass="rev-btn" class="rev-btn rev-medium rev-minround rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
						<a data-needclass="rev-btn" class="rev-btn rev-small rev-minround rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
					</div>
					<div class="addbutton-buttonrow">
						<a data-needclass="rev-btn" class="rev-btn rev-maxround rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
						<a data-needclass="rev-btn" class="rev-btn rev-medium rev-maxround rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
						<a data-needclass="rev-btn" class="rev-btn rev-small rev-maxround rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?></a>
					</div>
					<div class="addbutton-buttonrow">
						<a data-needclass="rev-btn rev-withicon" class="rev-btn rev-maxround rev-withicon rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
						<a data-needclass="rev-btn rev-withicon" class="rev-btn rev-medium rev-maxround rev-withicon rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
						<a data-needclass="rev-btn rev-withicon" class="rev-btn rev-small rev-maxround rev-withicon rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
					</div>
					<div class="addbutton-buttonrow">
						<a data-needclass="rev-btn rev-hiddenicon" class="rev-btn rev-maxround rev-hiddenicon rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
						<a data-needclass="rev-btn rev-hiddenicon" class="rev-btn rev-medium rev-maxround rev-hiddenicon rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
						<a data-needclass="rev-btn rev-hiddenicon" class="rev-btn rev-small rev-maxround rev-hiddenicon rev-bordered" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
					</div>
					<div class="addbutton-buttonrow">
						<a data-needclass="rev-btn rev-hiddenicon" class="rev-btn rev-maxround rev-hiddenicon rev-bordered rev-uppercase" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
						<a data-needclass="rev-btn rev-hiddenicon" class="rev-btn rev-medium rev-maxround rev-hiddenicon rev-bordered rev-uppercase" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
						<a data-needclass="rev-btn rev-hiddenicon" class="rev-btn rev-small rev-maxround rev-hiddenicon rev-bordered rev-uppercase" href="javascript:void(0);"><?php echo "Click Here"; ?><i class="icon-right-open"></i></a>
					</div>
					<span class="addbutton-title" style="margin-top:10px;margin-bottom:10px;"><?php echo "Predefined Elements"; ?></span>
					<div class="addbutton-buttonrow trans_bg">
						<div class="dark_trans_overlay"></div> 
						<div data-needclass="rev-burger revb-white" class="revb-white rev-burger" style="display:inline-block;margin-right:10px">
						  <span></span>
						  <span></span>
						  <span></span>
						</div>
						<div data-needclass="rev-burger revb-whitenoborder" class="revb-whitenoborder rev-burger" style="display:inline-block;margin-right:10px">
						  <span></span>
						  <span></span>
						  <span></span>
						</div>
						<div data-needclass="rev-burger revb-darkfull" class="revb-darkfull rev-burger" style="display:inline-block;margin-right:10px">
						  <span></span>
						  <span></span>
						  <span></span>
						</div>
						<div data-needclass="rev-burger revb-dark" class="revb-dark rev-burger" style="display:inline-block;margin-right:10px">
						  <span></span>
						  <span></span>
						  <span></span>
						</div>
						<div data-needclass="rev-burger revb-darknoborder" class="revb-darknoborder rev-burger" style="display:inline-block;margin-right:10px">
						  <span></span>
						  <span></span>
						  <span></span>
						</div>
						<div data-needclass="rev-burger revb-whitefull" class="revb-whitefull rev-burger" style="display:inline-block;margin-right:10px">
						  <span></span>
						  <span></span>
						  <span></span>
						</div>
						
						<div style="width:100%;height:25px;display:block"></div>
						<span data-needclass="rev-scroll-btn" class="rev-scroll-btn" style="margin-right:10px">							
							<span>
							</span>							
						</span>
						<span data-needclass="rev-scroll-btn revs-dark" class="rev-scroll-btn revs-dark" style="margin-right:10px">
							<span>
							</span>												
						</span>

						<span data-needclass="rev-scroll-btn revs-fullwhite" class="rev-scroll-btn revs-fullwhite" style="margin-right:10px">
							<span>
							</span>							
						</span>

						<span data-needclass="rev-scroll-btn revs-fulldark" class="rev-scroll-btn revs-fulldark" style="margin-right:10px">
							<span>
							</span>
						</span>

						<span data-needclass="" class="rev-control-btn rev-sbutton rev-sbutton-blue" style="margin-right:10px;vertical-align:top">
							<i class="fa-icon-facebook"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-sbutton rev-sbutton-lightblue" style="margin-right:10px;vertical-align:top">
							<i class="fa-icon-twitter"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-sbutton rev-sbutton-red" style="margin-right:10px;vertical-align:top">
							<i class="fa-icon-google-plus"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-sbutton" style="margin-right:10px;vertical-align:top">
							<i class="fa-icon-envelope"></i>
						</span>

						<div style="width:100%;height:25px;display:block"></div>
						<span data-needclass="" class="rev-control-btn rev-cbutton-dark" style="margin-right:10px">
							<i class="fa-icon-play"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-cbutton-light" style="margin-right:10px">
							<i class="fa-icon-play"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-cbutton-dark-sr" style="margin-right:10px">
							<i class="fa-icon-play"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-cbutton-light-sr" style="margin-right:10px">
							<i class="fa-icon-play"></i>
						</span>
						<div style="width:100%;height:25px;display:block"></div>
						<span data-needclass="" class="rev-control-btn rev-cbutton-dark" style="margin-right:10px">
							<i class="fa-icon-pause"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-cbutton-light" style="margin-right:10px">
							<i class="fa-icon-pause"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-cbutton-dark-sr" style="margin-right:10px">
							<i class="fa-icon-pause"></i>
						</span>

						<span data-needclass="" class="rev-control-btn rev-cbutton-light-sr" style="margin-right:10px">
							<i class="fa-icon-pause"></i>
						</span>
						<div style="width:100%;height:25px;display:block"></div>

						
					</div>
				</div>
			</div>
			<div id="addbutton-settings">
				<div class="adb-configs" style="padding-top:0px">
					<!-- TITLE -->
					<div class="add-togglebtn"><span class="addbutton-title"><?php echo "Idle State"; ?></span><span class="adb-toggler eg-icon-minus"></span></div>
					<div class="add-intern-accordion" style="display:block">
						<!-- COLOR 1 -->
						<div class="add-lbl-wrapper">
						<label><?php echo "Background"; ?></label>
						</div>					
						<!-- COLOR -->					
						<input type="text" class="rs-layer-input-field my-color-field" style="width:150px" name="adbutton-color-1" data-editing="Button Background" value="rgba(0,0,0,0.75)" />
						<span class="rs-layer-toolbar-space" style="margin-right:0px"></span>

						<!-- OPACITY -->
						<i class="rs-mini-layer-icon rs-icon-opacity rs-toolbar-icon " style="margin-right:5px"></i>
						<input data-suffix="" class="adb-input rs-layer-input-field "  style="width:45px" type="text" name="adbutton-opacity-1" value="0.75">
						

						
						<!-- TEXT / ICON -->
						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php echo "Color"; ?></label>
						</div>					
						<!-- TEXT COLOR -->					
						<input type="text" class="rs-layer-input-field  my-color-field" title="<?php _e("Color 2",'revslider'); ?>" style="width:150px" data-editing="Button Idle Color" data-mode="single" name="adbutton-color-2" value="rgba(255,255,255,1)" />
						<span class="rs-layer-toolbar-space" style="margin-right:0px"></span>					

						<!-- BORDER -->
						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php echo "Border"; ?></label>
						</div>					
						 <!-- BORDER COLOR -->					
						<input type="text" class="rs-layer-input-field  my-color-field" title="<?php _e("Border Color",'revslider'); ?>" style="width:150px" data-editing="Button Border Color" data-mode="single" name="adbutton-border-color" value="rgba(0,0,0,1)" />
						<span class="rs-layer-toolbar-space" style="margin-right:0px"></span>					
						

						<!-- BORDER WIDTH-->
						<i class="rs-mini-layer-icon rs-icon-borderwidth rs-toolbar-icon " title="<?php echo "Border Width"; ?>" style="margin-right:5px"></i>
						<input class="adb-input text-sidebar rs-layer-input-field " title="<?php echo "Border Width"; ?>" style="width:45px" type="text" name="adbutton-border-width" value="0">
						<div style="width:100%;height:5px"></div>
						
						<!-- ICON  & FONT-->
						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php echo "Text / Icon"; ?></label>
						</div>					
					
						<span class="addbutton-icon"><i class="fa-icon-chevron-right"></i></span>
						<span class="rs-layer-toolbar-space" style="margin-right:0px"></span>

						<i class="rs-mini-layer-icon rs-icon-fontfamily rs-toolbar-icon " title="<?php echo "Font Family"; ?>" style="margin-right:5px"></i>
						<input class="adb-input text-sidebar rs-layer-input-field " title="<?php echo "Font Family"; ?>" style="width:75px" type="text" name="adbutton-fontfamily" value="Roboto">
						
					</div>
				</div>
				<div class="adb-configs">
					<!-- TITLE -->
					<div class="add-togglebtn"><span class="addbutton-title"><?php echo "Hover State"; ?></span><span class="adb-toggler eg-icon-plus"></span></div>
					<div class="add-intern-accordion" style="display:none">
						<!-- COLOR 1 -->
						<div class="add-lbl-wrapper">
						<label><?php echo "Background"; ?></label>
						</div>					
						<!-- COLOR -->					
						<input type="text" class="rs-layer-input-field my-color-field" style="width:150px" name="adbutton-color-1-h" data-editing="Button Background Hover Color" value="rgba(255,255,255,1)" />
						<span class="rs-layer-toolbar-space" style="margin-right:0px"></span>

						<!-- TEXT / ICON -->
						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php echo "Color"; ?></label>
						</div>	
						
						<!-- TEXT COLOR -->					
						<input type="text" class="rs-layer-input-field  my-color-field" title="<?php _e("Color 2",'revslider'); ?>" style="width:150px" data-editing="Button Hover Color" data-mode="single" name="adbutton-color-2-h" value="rgba(0,0,0,1)" />
						<span class="rs-layer-toolbar-space" style="margin-right:0px"></span>					


						
						<!-- BORDER -->
						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php echo "Border"; ?></label>
						</div>					
						<!-- BORDER COLOR -->					
						<input type="text" class="rs-layer-input-field  my-color-field" title="<?php _e("Border Color",'revslider'); ?>" style="width:150px" data-editing="Button Border Hover Color" data-mode="single" name="adbutton-border-color-h" value="rgba(0,0,0,1)" />
						<span class="rs-layer-toolbar-space" style="margin-right:0px"></span>					
						

						<!-- BORDER WIDTH-->
						<i class="rs-mini-layer-icon rs-icon-borderwidth rs-toolbar-icon " title="<?php echo "Border Width"; ?>" style="margin-right:5px"></i>
						<input class="adb-input text-sidebar rs-layer-input-field " title="<?php echo "Border Width"; ?>" style="width:45px" type="text" name="adbutton-border-width-h" value="0">
						<div style="width:100%;height:5px"></div>
					</div>
					
					
				</div>
				<div class="adb-configs">	
					<div class="add-togglebtn"><span class="addbutton-title"><?php echo "Text"; ?></span><span class="adb-toggler eg-icon-plus"></span></div>
					<div class="add-intern-accordion" style="display:none">						
						<input class="adb-input text-sidebar rs-layer-input-field " style="width:100%" type="text" name="adbutton-text" value="Click Here">						
					</div>
				</div>

			</div>
		</div>
	</div>

	
	<!-- THE import DIALOG WINDOW -->
	<div id="dialog_addimport" class="dialog-addimport" title="<?php echo 'Import Layer'; ?>" style="display:none;">
		<div id="rs-import-layer-selector">

			<select name="rs-import-layer-slider" id="rs-import-layer-slider" class="rs-layer-input-field">
				<?php   
				if(!empty($arrSlidersFull)){
					?>
					<option value="-" selected="selected"><?php echo '-- Select a Slider --'; ?></option>
					<?php
					foreach($arrSlidersFull as $ls_id => $ls_title){
						?>
						<option value="<?php echo $ls_id; ?>"><?php echo $ls_title; ?></option>
						<?php
					}
				}else{
					?>
					<option value="-" selected="selected"><?php echo '-- No Slider Available --'; ?></option>
					<?php
				}
				?>
			</select>
			<select name="rs-import-layer-slide" id="rs-import-layer-slide" class="rs-layer-input-field">
				<option value="-" selected="selected"><?php echo '-- Select a Slide --'; ?></option>
				<option value="all" selected="selected"><?php echo 'All'; ?></option>
				
			</select>
			<select name="rs-import-layer-type" id="rs-import-layer-type" class="rs-layer-input-field">
				<option value="-" selected="selected"><?php echo '-- Select a Layer Type --'; ?></option>
				<option value="all"><?php echo 'All'; ?></option>
				<option value="text"><?php echo 'Text'; ?></option>
				<option value="image"><?php echo 'Image'; ?></option>
				<option value="video"><?php echo 'Video'; ?></option>
				<option value="button"><?php echo 'Button'; ?></option>
				<option value="shape"><?php echo 'Shape'; ?></option>
			</select>
			
			<ul id="rs-import-layer-holder">
				<div class="first-import-notice">
					<i class="eg-icon-download"></i>
					<span class="big-blue-block"><?php echo 'Select a Slider/Slide/Layer to Import'; ?></span>
				</div>
			</ul>
		</div>
	</div>
	
	<script type="text/html" id="tmpl-rs-import-layer-wrap">
		<li id="to-import-layer-id-{{ data['slide_id'] }}-{{ data['unique_id'] }}" data-id="{{ data['unique_id'] }}" data-actiondep="{{ data['action_layers'] }}" data-sliderid="{{ data['slider_id'] }}" data-slideid="{{ data['slide_id'] }}" class="import-layer-li-class import-action-{{ data['withaction'] }}"><i class="rs-icon-layer{{ data['type'] }}"></i><span class="rs-import-layer-name">{{ data['alias'] }}</span><span class="rs-import-layer-dimension">{{ data['width'] }} x {{ data['height'] }}</span><span class="import-layer-withaction"><?php echo "Action Available"; ?></span><span class="import-layer-tools"><span class="import-layer-imported"><?php echo "Layer Added to Stage"; ?></span><span class="import-layer-now"><i class="eg-icon-plus"></i></span></span></li>
	</script>

	<script tyle="javascript">	
		jQuery(document).ready(function() {
			
			function hoverActionAllChildren(el) {				
				var	actionarray = el.data('actiondep'),
					sid = el.data('slideid'),
					a = actionarray.length>1 ? actionarray.split(",") : new Array();

					if (a.length==0) a.push(actionarray);				

				if (a && a.length>0) {
					jQuery.each(a,function(i,uid) {
						jQuery('#to-import-layer-id-'+sid+'-'+uid).addClass("actionhover");
					});
				}
			}

			jQuery('body').on('mouseenter','.import-layer-li-class',function() {
				hoverActionAllChildren(jQuery(this));
			});

			jQuery('body').on('mouseleave','.import-layer-li-class',function() {
					jQuery('.import-layer-li-class.actionhover').removeClass("actionhover");
			});

			
		});
	</script>
	<!-- THE shape DIALOG WINDOW -->
	<div id="dialog_addshape" class="dialog-addshape" title="<?php echo "Add Shape Layer"; ?>" style="display:none">
		<div class="addbuton-dialog-inner">
			<div id="addshape-examples">
				<div class="addbe-title-row">					
					<span class="addshape-bg-light"></span>
					<span class="addshape-bg-dark"></span>
					<span class="addshape-title"><?php echo "Click your Shape below to add it"; ?></span>
				</div>
				<div class="addshape-examples-wrapper">
					
				</div>

			</div>
			<div id="addshape-settings">
				<div class="adb-configs" style="padding-top:0px">
					<!-- TITLE -->
					<span class="addshape-title"><?php echo "Shape Settings"; ?></span>
					<div class="add-intern-accordion" style="display:block">	
						<!-- COLOR 1 -->
						<div class="add-lbl-wrapper">
						<label><?php echo "Background"; ?></label>
						</div>					
							<!-- COLOR -->					
						<input type="text" class="rs-layer-input-field my-color-field" style="width:150px" data-editing="Shape Background Color" name="adshape-color-1" value="rgba(0,0,0,0.5)" />
						<span class="rs-layer-toolbar-space" style="margin-right:0px"></span>

						
						<!-- BORDER -->
						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php _e("Border",'revslider'); ?></label>
						</div>					

						<!-- BORDER COLOR -->					
						<input type="text" class="rs-layer-input-field  my-color-field" data-editing="Shape Border Color" title="<?php _e("Border Color",'revslider'); ?>" style="width:150px" data-mode="single" name="adshape-border-color" value="rgba(0,0,0,0.5)" />
						<span class="rs-layer-toolbar-space" style="margin-right:15px"></span>					
						

						<!-- BORDER WIDTH-->
						<i class="rs-mini-layer-icon rs-icon-borderwidth rs-toolbar-icon " title="<?php echo "Border Width"; ?>" style="margin-right:5px"></i>
						<input class="ads-input text-sidebar rs-layer-input-field " title="<?php echo "Border Width"; ?>" style="width:45px" type="text" name="adshape-border-width" value="0">
						<div style="width:100%;height:5px"></div>	


						<!-- BORDER RADIUS-->
						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php echo "Border Radius"; ?></label>
						</div>					
						<i class="rs-mini-layer-icon rs-icon-borderradius rs-toolbar-icon"  style="margin-right:10px"></i>
						<input data-suffix="px" class="ads-input text-sidebar rs-layer-input-field "  style="width:50px" type="text" name="shape_border-radius[]" value="0">
						<input data-suffix="px" class="ads-input text-sidebar rs-layer-input-field "  style="width:50px" type="text" name="shape_border-radius[]" value="0">
						<input data-suffix="px" class="ads-input text-sidebar rs-layer-input-field "  style="width:50px" type="text" name="shape_border-radius[]" value="0">
						<input data-suffix="px" class="ads-input text-sidebar rs-layer-input-field "  style="width:50px" type="text" name="shape_border-radius[]" value="0">
						
						<!-- SIZE OF SHAPE-->
						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php echo "Width"; ?></label>
						<span class="rs-layer-toolbar-space" style="margin-right:30px"></span>
						<label><?php echo "Full-Width"; ?></label> 
						</div>				
						<input class="ads-input text-sidebar rs-layer-input-field "  style="width:50px" type="text" name="shape_width" value="200">
						<span class="rs-layer-toolbar-space" style="margin-right:13px"></span>						
						<input type="checkbox" name="shape_fullwidth" class="tp-moderncheckbox"/>

						<div style="width:100%;height:5px"></div>
						<div class="add-lbl-wrapper">
						<label><?php echo "Height"; ?></label>
						<span class="rs-layer-toolbar-space" style="margin-right:30px"></span>
						<label><?php echo "Full-Height"; ?></label> 
						</div>				
						<input class="ads-input text-sidebar rs-layer-input-field "  style="width:50px" type="text" name="shape_height" value="200">
						<span class="rs-layer-toolbar-space" style="margin-right:13px"></span>						
						<input type="checkbox" name="shape_fullheight" class="tp-moderncheckbox"/>

						<div class="shape_padding">
							<!-- SIZE OF SHAPE-->
							<div style="width:100%;height:5px"></div>
							<div class="add-lbl-wrapper">
								<label><?php echo "Padding"; ?></label>
							</div>
							<i class="rs-mini-layer-icon rs-icon-padding rs-toolbar-icon" title="<?php echo "Padding"; ?>" style="margin-right:10px"></i>
							<input data-suffix="px" disabled class="ads-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Padding Top"; ?>" style="width:50px" type="text" name="shape_padding[]" value="0">
							<input data-suffix="px" disabled class="ads-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Padding Right"; ?>" style="width:50px" type="text" name="shape_padding[]" value="0">
							<input data-suffix="px" disabled class="ads-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Padding Bottom"; ?>" style="width:50px" type="text" name="shape_padding[]" value="0">
							<input data-suffix="px" disabled class="ads-input text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php echo "Padding Left"; ?>" style="width:50px" type="text" name="shape_padding[]" value="0">
							
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	
	<div id="dialog-change-style-from-css" title="<?php echo 'Apply Styles to Selection' ?>" style="display:none;width:275px">
				
		<div style="margin-top:3px;margin-bottom:13px;">
			<div class="rs-style-device-wrap"><div data-type="desktop" class="rs-style-device_selector_prev rs-preview-ds-desktop selected"></div><input type="checkbox" class="rs-style-device_input" name="rs-css-set-on[]" value="desktop" checked="checked" /></div><?php
		//check if advanced responsive size is enabled and which ones are
		if($adv_resp_sizes === true){
			if($enable_custom_size_notebook == 'on'){ ?><div class="rs-style-device-wrap"><div data-type="notebook" class="rs-style-device_selector_prev rs-preview-ds-notebook"></div><input type="checkbox" class="rs-style-device_input" name="rs-css-set-on[]" value="notebook" checked="checked" /></div><?php }
			if($enable_custom_size_tablet == 'on'){ ?><div class="rs-style-device-wrap"><div data-type="tablet" class="rs-style-device_selector_prev rs-preview-ds-tablet"></div><input type="checkbox" class="rs-style-device_input" name="rs-css-set-on[]" value="tablet" checked="checked" /></div><?php }
			if($enable_custom_size_iphone == 'on'){ ?><div class="rs-style-device-wrap"><div data-type="mobile" class="rs-style-device_selector_prev rs-preview-ds-mobile"></div><input type="checkbox" class="rs-style-device_input" name="rs-css-set-on[]" value="mobile" checked="checked" /></div><?php }
		}
		?>
		</div>
		
		<p style="margin:0px 0px 6px 0px;font-size:14px"><input type="checkbox" name="rs-css-include[]" value="color" checked="checked" /><?php echo 'Color'; ?></p>
		<p style="margin:0px 0px 6px 0px;font-size:14px"><input type="checkbox" name="rs-css-include[]" value="font-size" checked="checked" /><?php echo 'Font Size'; ?></p>
		<p style="margin:0px 0px 6px 0px;font-size:14px"><input type="checkbox" name="rs-css-include[]" value="line-height" checked="checked" /><?php echo 'Line Height'; ?></p>
		<p style="margin:0px 0px 6px 0px;font-size:14px"><input type="checkbox" name="rs-css-include[]" value="font-weight" checked="checked" /><?php echo 'Font Weight'; ?></p>
		<p style="margin:20px 0px 0px 0px;font-size:13px;color:#999;font-style:italic"><?php echo 'Advanced Styles will alwys be applied to all Device Sizes.'; ?></p>
	</div>
	
	<div id="delete-full-group-dialog" title="<?php echo 'Remove Group with Content' ?>" style="display:none;min-width:575px">
		<div class=""><?php echo 'Further Layers exist in the Container. Please choose from following options:' ?></div>		
	</div>

	

<script type="text/html" id="tmpl-rs-action-layer-wrap">
	<li class="layer_action_row layer_action_wrap">
		<# if(data['edit'] == true){ #>
		<div class="remove-action-row">
			<i class="eg-icon-minus"></i>
		</div>
		<# }else{ #>
		
		<# } #>
		
		<select name="<# if(data['edit'] == false){ #>no_<# } #>layer_tooltip_event[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:100px; margin-right:10px;">
			<option <# if( data['tooltip_event'] == 'click' ){ #>selected="selected" <# } #>value="click"><?php echo "Click"; ?></option>
			<option <# if( data['tooltip_event'] == 'mouseenter' ){ #>selected="selected" <# } #>value="mouseenter"><?php echo "Mouse Enter"; ?></option>
			<option <# if( data['tooltip_event'] == 'mouseleave' ){ #>selected="selected" <# } #>value="mouseleave"><?php echo "Mouse Leave"; ?></option>
		</select>
		
		<select name="<# if(data['edit'] == false){ #>no_<# } #>layer_action[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>layer_actions rs-layer-input-field" style="width:185px; margin-right:10px;">						
			<option <# if( data['action'] == 'none' ){ #>selected="selected" <# } #>value="none"><?php echo "Disabled"; ?></option>
			<option disabled></option>
			<option disabled>---- <?php echo "Link Actions"; ?> ----</option>
			<option <# if( data['action'] == 'link' ){ #>selected="selected" <# } #>value="link"><?php echo "Simple Link"; ?></option>
			<option <# if( data['action'] == 'callback' ){ #>selected="selected" <# } #>value="callback"><?php echo "CallBack"; ?></option>												
			<option <# if( data['action'] == 'scroll_under' ){ #>selected="selected" <# } #>value="scroll_under"><?php echo "Scroll Below Slider"; ?></option>
			<option disabled></option>
			<option disabled>---- <?php echo "Slide Actions"; ?> ----</option>			
			<option <# if( data['action'] == 'jumpto' ){ #>selected="selected" <# } #>value="jumpto"><?php echo "Jump to Slide"; ?></option>
			<option <# if( data['action'] == 'next' ){ #>selected="selected" <# } #>value="next"><?php echo "Next Slide"; ?></option>
			<option <# if( data['action'] == 'prev' ){ #>selected="selected" <# } #>value="prev"><?php echo "Previous Slide"; ?></option>
			<option <# if( data['action'] == 'pause' ){ #>selected="selected" <# } #>value="pause"><?php echo "Pause Slider"; ?></option>								
			<option <# if( data['action'] == 'resume' ){ #>selected="selected" <# } #>value="resume"><?php echo "Play Slider"; ?></option>																
			<option <# if( data['action'] == 'toggle_slider' ){ #>selected="selected" <# } #>value="toggle_slider"><?php echo "Toggle Slider"; ?></option>
			<option disabled></option>
			<option disabled>---- <?php echo "Layer Actions"; ?> ----</option>			
			<option <# if( data['action'] == 'start_in' ){ #>selected="selected" <# } #>value="start_in"><?php echo 'Start Layer "in" Animation'; ?></option>
			<option <# if( data['action'] == 'start_out' ){ #>selected="selected" <# } #>value="start_out"><?php echo 'Start Layer "out" Animation'; ?></option>
			<option <# if( data['action'] == 'toggle_layer' ){ #>selected="selected" <# } #>value="toggle_layer"><?php echo 'Toggle Layer Animation'; ?></option>
			<option disabled></option>
			<option disabled>---- <?php echo "Media Actions"; ?> ----</option>			
			<option <# if( data['action'] == 'start_video' ){ #>selected="selected" <# } #>value="start_video"><?php echo 'Start Media'; ?></option>
			<option <# if( data['action'] == 'stop_video' ){ #>selected="selected" <# } #>value="stop_video"><?php echo 'Stop Media'; ?></option>
			<option <# if( data['action'] == 'toggle_video' ){ #>selected="selected" <# } #>value="toggle_video"><?php echo 'Toggle Media'; ?></option>			
			<option <# if( data['action'] == 'mute_video' ){ #>selected="selected" <# } #>value="mute_video"><?php echo 'Mute Media'; ?></option>
			<option <# if( data['action'] == 'unmute_video' ){ #>selected="selected" <# } #>value="unmute_video"><?php echo 'Unmute Media'; ?></option>
			<option <# if( data['action'] == 'toggle_mute_video' ){ #>selected="selected" <# } #>value="toggle_mute_video"><?php echo 'Toggle Mute Media'; ?></option>			
			<option <# if( data['action'] == 'toggle_global_mute_video' ){ #>selected="selected" <# } #>value="toggle_global_mute_video"><?php echo 'Toggle Mute All Media'; ?></option>			
			<option disabled></option>
			<option disabled>---- <?php echo "Fullscreen  Actions"; ?> ----</option>
			<option <# if( data['action'] == 'togglefullscreen' ){ #>selected="selected" <# } #>value="togglefullscreen"><?php echo "Toggle FullScreen"; ?></option>
			<option <# if( data['action'] == 'gofullscreen' ){ #>selected="selected" <# } #>value="gofullscreen"><?php echo "Go FullScreen"; ?></option>
			<option <# if( data['action'] == 'exitfullscreen' ){ #>selected="selected" <# } #>value="exitfullscreen"><?php echo "Exit FullScreen"; ?></option>
			<option disabled></option>
			<option disabled>---- <?php echo "Advanced  Actions"; ?> ----</option>
			<option <# if( data['action'] == 'simulate_click' ){ #>selected="selected" <# } #>value="simulate_click"><?php echo 'Simulate Click'; ?></option>
			<option <# if( data['action'] == 'toggle_class' ){ #>selected="selected" <# } #>value="toggle_class"><?php echo 'Toggle Layer Class'; ?></option>
			
			<?php do_action( 'rs_action_add_layer_action' );  ?>
		</select>
		<!-- SIMPLE LINK PARAMETERS -->
		<span class="action-link-wrapper" style="display:none;">
			<!--<span><?php echo "Link Url"; ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<input type="text" style="width:150px;margin-right:10px;" placeholder="<?php echo "Link Url"; ?>" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption rs-layer-input-field"  name="<# if(data['edit'] == false){ #>no_<# } #>layer_image_link[]" value="{{ data['image_link'] }}">

			<!--<span><?php echo "Link Target"; ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<select name="<# if(data['edit'] == false){ #>no_<# } #>layer_link_open_in[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:150px;margin-right:10px;">
				<option <# if( data['link_open_in'] == '_same' ){ #>selected="selected" <# } #>value="_self"><?php echo "Same Window"; ?></option>
				<option <# if( data['link_open_in'] == '_blank' ){ #>selected="selected" <# } #>value="_blank"><?php echo "New Window"; ?></option>
			</select>
			
			<!--<span><?php echo "Link Type"; ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<select name="<# if(data['edit'] == false){ #>no_<# } #>layer_link_type[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:150px; margin-right:10px">
				<option <# if( data['link_type'] == 'jquery' ){ #>selected="selected" <# } #>value="jquery"><?php echo "jQuery Link"; ?></option>
				<option <# if( data['link_type'] == 'a' ){ #>selected="selected" <# } #>value="a"><?php echo "a Tag Link"; ?></option>
			</select>
                        <select name="<# if(data['edit'] == false){ #>no_<# } #>layer_link_follow[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:150px; margin-right:10px">
				<option <# if( data['link_follow'] == 'follow' ){ #>selected="selected" <# } #>value="follow"><?php _e("follow",'revslider'); ?></option>
				<option <# if( data['link_follow'] == 'nofollow' ){ #>selected="selected" <# } #>value="nofollow"><?php _e("nofollow",'revslider'); ?></option>
			</select>
		</span>


		<!-- JUMP TO SLIDE -->
		<span class="action-jump-to-slide" style="display:none;">
			<!--<span><?php echo "Jump To"; ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<select name="<# if(data['edit'] == false){ #>no_<# } #>jump_to_slide[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:150px; margin-right:10px" data-selectoption="{{ data['jump_to_slide'] }}">
			</select>		
		</span>

		<!-- SCROLL OFFSET -->
		<span class="action-scrollofset" style="display:none;">						
			<!--<span><?php echo "Scroll Offset"; ?></span>
			<span class="rs-layer-toolbar-space" ></span>-->
			<input type="text" style="width:125px;; margin-right:10px" placeholder="<?php echo "Scroll Offset"; ?>" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption rs-layer-input-field"  name="<# if(data['edit'] == false){ #>no_<# } #>layer_scrolloffset[]" value="{{ data['scrolloffset'] }}">						
		</span>

		<!-- CALLBACK FUNCTION-->
		<span class="action-callback" style="display:none;">						
			<!--<span><?php echo "Function"; ?></span>
			<span class="rs-layer-toolbar-space" ></span>-->
			<input type="text" style="width:250px;; margin-right:10px" placeholder="<?php echo "Function"; ?>" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption rs-layer-input-field"  name="<# if(data['edit'] == false){ #>no_<# } #>layer_actioncallback[]" value="{{ data['actioncallback'] }}">						
		</span>

		<span class="action-target-layer" style="display:none;">
			<!--<span><?php echo "Target"; ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<select name="<# if(data['edit'] == false){ #>no_<# } #>layer_target[]" id="layer_target" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:100px;margin-right:10px;" data-selectoption="{{ data['layer_target'] }}">
			</select>
			
		</span>		


		<span class="action-toggle_layer" style="display:none;">
			<!--<span class="rs-layer-toolbar-space"></span>
			<span><?php echo "at Start"; ?></span>-->
			<select name="<# if(data['edit'] == false){ #>no_<# } #>toggle_layer_type[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:150px; margin-right:10px">
				<option <# if( data['toggle_layer_type'] == 'visible' ){ #>selected="selected" <# } #>value="visible"><?php echo "Play In Animation"; ?></option>
				<option <# if( data['toggle_layer_type'] == 'hidden' ){ #>selected="selected" <# } #>value="hidden"><?php echo "Keep Hidden"; ?></option>
			</select>
		</span>	

		<!-- TOGGLE CLASS FUNCTION-->
		<span class="action-toggleclass" style="display:none;">	
			<!--<span class="rs-layer-toolbar-space"></span>
			<span><?php echo "Class"; ?></span>
			<span class="rs-layer-toolbar-space" ></span>-->
			<input type="text" style="width:100px;margin-right:10px" placeholder="<?php echo "Class to Toggle"; ?>" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption rs-layer-input-field"  name="<# if(data['edit'] == false){ #>no_<# } #>layer_toggleclass[]" value="{{ data['toggle_class'] }}">
		</span>
		
		<!-- Trigger States -->
		<span class="action-triggerstates" style="display: none; white-space:nowrap">
			<!--<span class="rs-layer-toolbar-space" style="margin-left:42px"></span>
			<span><?php echo "Animation Timing"; ?></span>
			<span class="rs-layer-toolbar-space" ></span>-->
			<select name="<# if(data['edit'] == false){ #>no_<# } #>do-layer-animation-overwrite[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:150px !important; margin-right:10px">
				<option value="default"><?php echo "In and Out Animation Default"; ?></option>
				<option value="waitout"><?php echo "In Animation Default and Out Animation Wait for Trigger"; ?></option>
				<option value="wait"><?php echo "Wait for Trigger"; ?></option>
			</select>
			<!--<span class="rs-layer-toolbar-space" ></span>
			<span><?php echo "Trigger Memory"; ?></span>
			<span class="rs-layer-toolbar-space" ></span>-->
			<select name="<# if(data['edit'] == false){ #>no_<# } #>do-layer-trigger-memory[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:150px; margin-right:10px">
				<option value="reset"><?php echo "Reset Animation and Trigger States every loop"; ?></option>
				<option value="keep"><?php echo "Keep last selected State"; ?></option>
			</select>
		</span>

		<?php do_action( 'rs_action_add_layer_action_details',$slider ); ?>

		<span class="action-delay-wrapper" style="display: none; white-space:nowrap">			
			<!--<span><?php echo "Delay"; ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<input type="text" style="width:60px;margin-top:-2px" placeholder="<?php echo "Delay"; ?>" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption rs-layer-input-field" name="<# if(data['edit'] == false){ #>no_<# } #>layer_action_delay[]" value="{{ data['action_delay'] }}"> <?php echo 'ms'; ?>
		</span>
<!-- EASING -->
		<span class="action-easing-wrapper" style="display:none;">
			<!--<span><?php _e("Easing",'revslider'); ?></span>
			<span class="rs-layer-toolbar-space" ></span>-->
			<select name="<# if(data['edit'] == false){ #>no_<# } #>layer-action-easing[]" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>rs-layer-input-field" style="width:150px; margin-right:10px">
				<?php
				foreach($easings as $ehandle => $ename){
					echo '<option value="'.$ehandle.'" <# if( data[\'action_easing\'] == \''.$ehandle.'\' ){ #>selected="selected" <# } #>>'.$ename.'</option>';
				}
				?>
			</select>
		</span>
		
		<!-- SPEED -->
		<span class="action-speed-wrapper" style="display:none;">
			<!--<span><?php _e("Speed",'revslider'); ?></span>
			<span class="rs-layer-toolbar-space" ></span>-->
			<input type="text" style="width:60px;margin-top:-2px" placeholder="<?php _e("Speed",'revslider'); ?>" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption rs-layer-input-field"  name="<# if(data['edit'] == false){ #>no_<# } #>layer_action_speed[]" value="{{ data['action_speed'] }}"> <?php _e('ms', 'revslider'); ?>
		</span>
		
		<?php do_action( 'rs_action_add_layer_action_details',$slider ); ?>


	</li>
</script>

	<script>
		// CHANGE STYLE OF EXAMPLE BUTTONS ON DEMAND
		// RGBA HEX CALCULATOR
		var local_cHex = function(hex,o){	
			o = parseFloat(o);
		    hex = hex.replace('#','');	    
		    var r = parseInt(hex.substring(0,2), 16),
		    	g = parseInt(hex.substring(2,4), 16),
		    	b = parseInt(hex.substring(4,6), 16),
				result = 'rgba('+r+','+g+','+b+','+o+')';
		    return result;
		}

		var getButtonExampleValues = function() {
			var o = new Object();

			o.bgc = window.RevColor.get(jQuery('input[name="adbutton-color-1"]').val());
			o.col = window.RevColor.get(jQuery('input[name="adbutton-color-2"]').val());
			o.borc = window.RevColor.get(jQuery('input[name="adbutton-border-color"]').val());
			o.bgch = window.RevColor.get(jQuery('input[name="adbutton-color-1-h"]').val());
			o.colh = window.RevColor.get(jQuery('input[name="adbutton-color-2-h"]').val());
			o.borch = window.RevColor.get(jQuery('input[name="adbutton-border-color-h"]').val());


			o.borw = parseInt(jQuery('input[name="adbutton-border-width"]').val(),0)+"px";
			o.borwh = parseInt(jQuery('input[name="adbutton-border-width-h"]').val(),0)+"px";
			
			o.ff = jQuery('input[name="adbutton-fontfamily"]').val();
			return o;
		}
var setExampleButtons = function() {
			var c = jQuery('#addbutton-examples');
			c.find('.rev-btn').each(function() {
				var b = jQuery(this),
					o = getButtonExampleValues();
								
				b.css({backgroundColor:o.bgc,
					   color:o.col,
					   fontFamily:o.ff});
				
				b.find('i').css({color:o.col});


				if (b.hasClass("rev-bordered"))
					b.css({borderColor:o.borc,borderWidth:o.borw,borderStyle:"solid"})

				if (b.find('i').length>0) {
					b.find('i').remove();
					b.html(jQuery('input[name="adbutton-text"]').val());
					b.append(jQuery('.addbutton-icon').html());					
				} else {					
					b.html(jQuery('input[name="adbutton-text"]').val());
				}

				b.unbind('hover');
				b.hover(function() {
					var b = jQuery(this),
					o = getButtonExampleValues();				
					b.css({background:o.bgch,color:o.colh});
					b.find('i').css({color:o.colh});					
					if (b.hasClass("rev-bordered"))
						b.css({borderColor:o.borch,borderWidth:o.borwh,borderStyle:"solid"});
				},
				function() {
					var b = jQuery(this),
					o = getButtonExampleValues();				
					b.css({background:o.bgc,color:o.col});
					b.find('i').css({color:o.col});					
					if (b.hasClass("rev-bordered"))
						b.css({borderColor:o.borc,borderWidth:o.borw,borderStyle:"solid"});
				})

			})
		}

		var setExampleShape = function() {
			var p = jQuery('.addshape-examples-wrapper'),
				o = new Object();
			
			o.bgc = window.RevColor.get(jQuery('input[name="adshape-color-1"]').val());
			o.borc = window.RevColor.get(jQuery('input[name="adshape-border-color"]').val());

			o.w = parseInt(jQuery('input[name="shape_width"]').val(),0);
			o.h = parseInt(jQuery('input[name="shape_height"]').val(),0);
			
			o.borw = parseInt(jQuery('input[name="adshape-border-width"]').val(),0)+"px";			
			o.fw = jQuery('input[name="shape_fullwidth"]').is(':checked');
			o.fh = jQuery('input[name="shape_fullheight"]').is(':checked');	
			o.br = "";

			if (o.fw) {
				o.w = "100%";
				o.l = "0px";
				o.ml = "0px";
				jQuery('input[name="shape_width"]').attr("disabled","disabled");
			} else {
				o.w = parseInt(o.w,0)+"px";
				o.l="50%";
				o.ml = 0 - parseInt(o.w,0)/2;
				jQuery('input[name="shape_width"]').removeAttr("disabled");				
			}

			if (o.fh) {
				o.h = "100%";
				o.t = "0px";
				o.mt = "0px";
				jQuery('input[name="shape_height"]').attr("disabled","disabled");				
			} else {
				o.h = parseInt(o.h,0)+"px";
				o.t = "50%";
				o.mt = 0 - parseInt(o.h,0)/2;
				jQuery('input[name="shape_height"]').removeAttr("disabled");				
			}

			jQuery('input[name="shape_border-radius[]"]').each(function(i){		
				var t = jQuery.isNumeric(jQuery(this).val()) ? parseInt(jQuery(this).val(),0)+"px" : jQuery(this).val();
				o.br = o.br + t;
				o.br = i<3 ? o.br+" ":o.br;
			});
			o.pad="";
			if (o.fh && o.fw) {
				jQuery('input[name="shape_padding[]"]').removeAttr("disabled");
				jQuery('input[name="shape_padding[]"]').each(function(i){
					var t = jQuery.isNumeric(jQuery(this).val()) ? parseInt(jQuery(this).val(),0)+"px" : jQuery(this).val();
					o.pad = o.pad + t;
					o.pad = i<3 ? o.pad+" ":o.pad;

				});
			} else {
				jQuery('input[name="shape_padding[]"]').attr("disabled","disabled");
				o.pad="0";
				
			}
			
			if (p.find('.example-shape').length==0)
				p.append('<div class="example-shape-wrapper"><div class="example-shape"></div></div>');
			var e = p.find('.example-shape');

			e.css({background:window.RevColor.get(o.bgc), 
				   padding:o.pad,				   
				   borderStyle:"solid", borderWidth:o.borw, borderColor:o.borc, borderRadius:o.br});
			e.parent().css({
					top:o.t, left:o.l, marginLeft:o.ml,marginTop:o.mt,
				  	width:o.w, height:o.h,
					padding:o.pad
			})
			RevSliderSettings.onoffStatus(jQuery('input[name="shape_fullwidth"]'));
			RevSliderSettings.onoffStatus(jQuery('input[name="shape_fullheight"]'));
		}

		

		jQuery(document).ready(function() {

			jQuery('#quick-layers-list-id').perfectScrollbar({wheelPropagation:false});

			// MANAGE BG COLOR OF DIALOG BOXES
			jQuery('.addbutton-bg-dark').click(function() { jQuery('#addbutton-examples').css({backgroundColor:"#333333"});})
			jQuery('.addbutton-bg-light').click(function() { jQuery('#addbutton-examples').css({backgroundColor:"#eeeeee"});})
			jQuery('.addshape-bg-dark').click(function() { jQuery('#addshape-examples').css({backgroundColor:"#333333"});})
			jQuery('.addshape-bg-light').click(function() { jQuery('#addshape-examples').css({backgroundColor:"#eeeeee"});})
			
			// ADD BUTTON DIALOG RELEVANT FUNCTIONS
			jQuery('.addbutton-examples-wrapper').perfectScrollbar({wheelPropagation:true});
			jQuery('.add-togglebtn').click(function() {
				var aia = jQuery(this).parent().find('.add-intern-accordion');
				aia.addClass("nowactive");
				jQuery('.add-intern-accordion').each(function() {
					if (!jQuery(this).hasClass("nowactive")) jQuery(this).slideUp(200);
				});
				jQuery('.adb-toggler').removeClass("eg-icon-minus").addClass("eg-icon-plus");
				aia.slideDown(200);
				jQuery(this).find('.adb-toggler').addClass("eg-icon-minus").removeClass("eg-icon-plus");
				aia.removeClass("nowactive");
			})


			jQuery('body').on("click","fake-select-i, #fake-select-label" ,function() {
				var tab = jQuery('#slide-animation-settings-content-tab');
				tab.click();
				jQuery("html, body").animate({scrollTop:(tab.offset().top-200)+"px"},{duration:400});
			})

			jQuery('#divLayers-wrapper').perfectScrollbar({ suppressScrollY:true});

			
			function makelayerswrapperscrollable() {
				jQuery('.master-rightcell .layers-wrapper').perfectScrollbar({wheelPropagation:true, suppressScrollY:true});
				jQuery('.master-leftcell .layers-wrapper').perfectScrollbar({wheelPropagation:true,suppressScrollX:true});					
			}

			document.addEventListener('ps-scroll-y', function (e) {
				if (jQuery(e.target).closest('.master-rightcell').length>0) {
					var st = jQuery('.master-rightcell .layers-wrapper').scrollTop();							
					jQuery('.master-leftcell .layers-wrapper').scrollTop(st);						
				} else
		        if (jQuery(e.target).closest('.master-leftcell').length>0) {
	        		var st = jQuery('.master-leftcell .layers-wrapper').scrollTop();
					jQuery('.master-rightcell .layers-wrapper').scrollTop(st);												
				}				
		    });

			document.addEventListener('ps-scroll-x', function (e) {
				 if (jQuery(e.target).closest('.master-rightcell').length>0) {
					 	var ls = parseInt(jQuery('.master-rightcell .layers-wrapper').scrollLeft(),0);
						jQuery('#master-rightheader').css({left:(15-ls)}).data('left',(15-ls));
				 }
			});

			jQuery('#master-rightheader').data('left',15);
			
			makelayerswrapperscrollable();
			

			var bawi = jQuery('#thelayer-editor-wrapper').outerWidth(true)-2;
			//jQuery('.master-rightcell').css({maxWidth:bawi-222});
			jQuery('#mastertimer-wrapper').css({maxWidth:bawi});
			jQuery('.layers-wrapper').css({maxWidth:bawi-222});
			var scrint;



			jQuery(window).resize(function() {
				var bawi = jQuery('#thelayer-editor-wrapper').outerWidth(true)-2;
				//jQuery('.master-rightcell').css({maxWidth:bawi-222});
				jQuery('#mastertimer-wrapper').css({maxWidth:bawi});
				jQuery('.layers-wrapper').css({maxWidth:bawi-222});
				jQuery('.master-rightcell .layers-wrapper, #divLayers-wrapper').perfectScrollbar("update");
				jQuery('#nls-wrapper').css({minWidth:(jQuery('#thelayer-editor-wrapper').width()+80)});
			});

			jQuery('#mastertimer-wrapper').resizable({
				handles:"s",
				minHeight:102,
				alsoResize:".layers-wrapper",
				start:function() {
					jQuery('.master-rightcell .layers-wrapper').perfectScrollbar("destroy");
				},
				resize:function() {
					
				},
				stop:function() {
					var maxh = ((jQuery('#layers-right ul li').length+1)*30) - ((jQuery('#layers-right ul li.layer-deleted').length+1)*30),	
						curh = jQuery('#mastertimer-wrapper').height();
					
					if (curh>maxh+3) {
						punchgs.TweenLite.set(jQuery('.layers-wrapper'),{height:maxh+3});
						punchgs.TweenLite.set(jQuery('#mastertimer-wrapper'),{height:maxh+3})
					}
					
					jQuery('.master-rightcell .layers-wrapper').perfectScrollbar({wheelPropagation:true});
					jQuery('.master-leftcell .layers-wrapper').perfectScrollbar({wheelPropagation:true, suppressScrollX:true});
					jQuery('#mastertimer-curtime-b').height(maxh+3);
				}
			});
			jQuery('#sticky_layersettings_toggle, #stickystylesbutton_wrap').click(function() {
				jQuery('#sticky_layersettings_toggle').toggleClass("selected");
				//admin ajax
				UniteAdminRev.ajaxRequest('slide_editor_sticky_menu', {'set_sticky': jQuery('#sticky_layersettings_toggle').hasClass('selected')}, function(response){}, true);
				handleStickySlideMenu();
			})

			function handleStickySlideMenu() {
				<!-- STICKY MENU IN HEADER -->
				var m = jQuery('#nls-wrapper'),
		 			f = jQuery('#nls-wrapper-fake'),
		 			mo = m.offset().top;	
		 		
				 		
			 	function manageFixedMenu() {
			 		
			 		var tp = jQuery(window).scrollTop(),
			 			wph = jQuery('#wpadminbar').height(),
			 			dh = jQuery(document).height();
			 		
			 		if (mo<tp+wph && !jQuery('#sticky_layersettings_toggle').hasClass("selected")) {			 						 			
			 			f.css({marginBottom:(m.height())+"px"});
			 			m.css({position:"fixed",top:wph+"px", maxWidth:jQuery('#tp_rs_a_form').width()+"px"});			 			
			 			m.addClass("isfixed");
			 			jQuery('#stickystylesbutton_wrap').removeClass("notyetsticky");
			 		} else {			 						 			
			 			m.css({position:"relative",top:"auto", maxWidth:"100%"});	
			 			m.removeClass("isfixed");
			 			f.css({marginBottom:"0px"});
			 			mo = m.offset().top;			
			 			jQuery('#stickystylesbutton_wrap').addClass("notyetsticky"); 		
			 		}
			 					 	
			 	}
			 	//jQuery(window).scroll(manageFixedMenu);			 	
			 	//setTimeout(manageFixedMenu,100);
			}

			handleStickySlideMenu();

			<?php
			$stage_collapse = RevSliderBase::getVar($global_settings, "stage_collapse",'off');
			if($stage_collapse == 'on'){
				?>
				jQuery('body').addClass("folded");
				<?php
			}
			?>
			jQuery(window).trigger("resize");
			jQuery('#collapse-menu').on('click',function() {
				setTimeout(function() {
					jQuery(window).trigger("resize");
				},100);
			});
			UniteAdminRev.initVideoDef();

			
		});
	</script>
</div>