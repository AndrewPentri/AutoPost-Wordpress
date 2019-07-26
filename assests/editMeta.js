jQuery(document).ready(function ($) {
    let date;
   $('.ap-wp-plugin-edit-button').click(function () {
       $('.ap-wp-plugin-editor-field').css({'display':'inline-block'});
       $('.ap-button').css({'display':'none'});
   });

   $('.ap-wp-plugin-editor-field-button').click(function () {
       $('.ap-wp-plugin-editor-field').css({'display':'none'});
       $('.ap-button').css({'display':'inline-block'});
       date = $('input[name*="ap-wp-plugin-date"]').val();
       if(date){
           $("#ap-wp-plugin-metafield").text("AutoPost Editor: The post will be unpublished on ");
           $(".text-label").text(date);
       }
   });

   $('.ap-wp-plugin-clear-button').click(function () {
       $("#ap-wp-plugin-metafield").text("AutoPost Editor: ");
       $(".text-label").text("Non-selected");
       $('input[name*="ap-wp-plugin-date"], .datepicker').val("Non-selected");
   });
    $('input[name*="ap-wp-plugin-date"], .datepicker').datepicker({ dateFormat: 'dd.mm.yy' });
});
