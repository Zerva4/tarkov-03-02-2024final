window.onload = function () {
    if (window.CKEDITOR) {
        // configure 'connectorPath' according to your own application
        CKFinder.config( { connectorPath: '/ckfinder/connector' } );
        for (var ckInstance in CKEDITOR.instances){
            CKFinder.setupCKEditor(CKEDITOR.instances[ckInstance]);
        }
    }
}