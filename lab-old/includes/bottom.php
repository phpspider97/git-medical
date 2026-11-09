 <!-- footer start-->
 <footer class="footer bg-dark">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0 text-white">Test Report</p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0 text-white">Made by: <a href="https://thecoderjob.com" target="_blank">The Coder Job</a></p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    
    <!-- latest jquery-->
    <script src="<?= SITE_URL;?>/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="<?= SITE_URL;?>/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?= SITE_URL;?>/assets/js/sidebar-menu.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="<?= SITE_URL;?>/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->

    <script src="<?= SITE_URL;?>/assets/js/prism/prism.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/clipboard/clipboard.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/counter/counter-custom.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/custom-card/custom-card.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/general-widget.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/height-equal.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?= SITE_URL;?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/datatable/datatables/datatable.custom.js"></script>
    <!-- <script src="<?= SITE_URL;?>/assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/editor/ckeditor/adapters/jquery.js"></script> -->
    <script src="<?= SITE_URL;?>/assets/js/dropzone/dropzone.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/dropzone/dropzone-script.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/select2/select2.full.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/select2/select2-custom.js"></script>



    <!-- <script src="<?= SITE_URL;?>/assets/js/editor/simple-mde/simplemde.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/editor/simple-mde/simplemde.custom.js"></script> -->
    <script src="<?= SITE_URL;?>/assets/js/jquery.ui.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
     

    <!-- <script src="<?= SITE_URL;?>/assets/js/editor/summernote/summernote.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/editor/summernote/summernote.custom.js"></script> -->
    <script src="<?= SITE_URL;?>/assets/js/tooltip-init.js"></script>
    

    <script src="<?= SITE_URL;?>/assets/js/script.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/theme-customizer/customizer1.js"></script>
    <?php  
     
        $_SESSION['Console/Mode'] = '"collapse"';
        $_SESSION['page-wrapper'] = 'horizontal-wrapper';
        $_SESSION['NavigationWidth'] = '240';
        $_SESSION['page-body-wrapper'] = 'horizontal-menu';
    ?>
    <script>
        CKEDITOR.replace( 'editor' );
        //console.log(CKEDITOR.config.plugins);
        //Plugin name
        //dialogui,dialog,about,a11yhelp,basicstyles,blockquote,notification,button,toolbar,clipboard,panel,floatpanel,menu,contextmenu,resize,elementspath,enterkey,entities,popup,filetools,filebrowser,floatingspace,listblock,richcombo,format,horizontalrule,htmlwriter,wysiwygarea,image,indent,indentlist,fakeobjects,link,list,magicline,maximize,pastetext,pastetools,pastefromgdocs,pastefromword,removeformat,showborders,sourcearea,specialchar,menubutton,scayt,stylescombo,tab,table,tabletools,tableselection,undo,lineutils,widgetselection,widget,notificationaggregator,uploadwidget,uploadimage,wsc

        CKEDITOR.on('instanceReady', function(e) {
          console.log(e.editor.document);
            e.editor.document.getBody().setStyle('background-color', 'black');
            e.editor.document.getBody().setStyle('color', 'white');
        });

        CKEDITOR.config.removePlugins = ['pastetext','pastetools','pastefromgdocs','pastefromword','undo','about','removeformat','strike'];
          
    </script>

  </body>
</html>