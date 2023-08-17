<div class="col-md-11 mt-5">
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="shadow-sm p-4 mb-4 bg-white boderbottom">
            <h5>Export And Download Content</h5>
        </div>
        <form id="frm-chkbox-data">
            <ul>
                <li id="prtbkuppwd">
                    <fluent-checkbox value="true" class="exportdata" name="exportdata[]" id="prtbkuppwd">
                        Protect this backup with a password
                    </fluent-checkbox>
                </li>
                <div id="prtbkuppwdfields" style="margin-left:2em; display:none;">
                    <fluent-text-field type="password" appearance="filled" name="password" id="password" placeholder="Enter a password"></fluent-text-field>
                    <fluent-text-field type="password" appearance="filled" name="confpassword" id="confpassword" placeholder="Repeat the password"></fluent-text-field>
                    <div style="margin-top: 3px;margin-bottom: 6px;" id="CheckPasswordMatch"></div>
                </div>
                <li>
                    <fluent-checkbox class="exportdata" name="dontexptpostrevisions" id="dontexptpostrevisions" value="dontexptpostrevisions">
                        Do not export post revisions
                    </fluent-checkbox>
                </li>
                <li>
                    <fluent-checkbox class="exportdata" name="dontexptsmedialibrary" id="dontexptsmedialibrary" value="dontexptsmedialibrary">
                        Do not export media library (files)
                    </fluent-checkbox>
                </li>
                <li>
                    <fluent-checkbox class="exportdata" name="dontexptsthems" id="dontexptsthems" value="dontexptsthems">
                        Do not export themes (files)
                    </fluent-checkbox>
                </li>
                <li>
                    <fluent-checkbox class="exportdata" name="dontexptmustuseplugs" id="dontexptmustuseplugs" value="dontexptmustuseplugs">
                        Do not export must-use plugins (files)
                    </fluent-checkbox>
                </li>
                <li>
                    <fluent-checkbox class="exportdata" name="dontexptplugins" id="dontexptplugins" value="dontexptplugins">
                        Do not export plugins (files)
                    </fluent-checkbox>
                </li>
                <li>
                    <fluent-checkbox class="exportdata" name="donotdbsql" id="dbsql" value="donotdbsql" style="display: none;">
                        Do not Export database (SQL)
                    </fluent-checkbox>
                </li>
            </ul>
            <div>
                <fluent-button class="generatefile" name="generatefile" id="generatefile" appearance="accent">
                    Generate Export File
                </fluent-button>
            </div>
            <br>
            <div id="downloadLink" style="display:none;">
                <a href="#" onclick="downloadLogFile()" class="download-link">Download Log File</a>
            </div>
        </form>
        <div id="exportdownloadfile">
            <?php
            $wp_root_url = get_home_url();
            $wp_root_filepath = $wp_root_url . "/wp-content/plugins/azure_app_service_migration/ExportedFile/";
            $dirname = AASM_EXPORT_ZIP_LOCATION;
            $reportfiles = scandir($dirname, 1);
            foreach ($reportfiles as $file) {
                if (substr($file, -4) == ".zip") {
                    $folderpath = $wp_root_filepath;
                    $finame = $folderpath . '' . $file;
                    print "<a style='color:#ffffff;margin-top:2em' href='" . $folderpath . "" . $file . "' name='downloadfile' id='downloadfile' class='btn btn-success btn-sm'>Download Export File - $file</a>";
                }
            }
            //$src = 'https://unpkg.com/@fluentui/web-components';
            $src = $wp_root_url . "/wp-content/plugins/azure_app_service_migration/assets/node_modules/@fluentui/web-components/dist/web-components.js";
            ?>
            <div class="overlay"></div>
        </div>
        <div class="alert-container">
            <div class="alert-box">
                <p id="alert-message"></p>
                <button onclick="hideAlert()">OK</button>
            </div>
        </div>
    </div>
</div>

<script type="module" src="<?php echo esc_url($src); ?>"></script>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("#prtbkuppwdfields").hide();
    });

    $('#prtbkuppwd').click(function() {
        if ($(this).prop('checked')) {
            $("#prtbkuppwdfields").hide();
            $("#password").val("");
            $("#confpassword").val("");
        } else {
            $("#prtbkuppwdfields").show();
        }
    });

    function downloadLogFile() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo get_home_url(); ?>/wp-content/plugins/azure_app_service_migration/Logs/export_log.txt', true);
        xhr.responseType = 'blob';

        xhr.onload = function() {
            if (xhr.status === 200) {
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(xhr.response);
                link.download = 'export_log.txt';
                link.click();
            }
        };

        xhr.send();
          // Check the visibility of exportdownloadfile and toggle the download link accordingly
          var exportDownloadFile = document.getElementById('exportdownloadfile');
    var downloadLink = document.getElementById('downloadLink');

    if (exportDownloadFile.style.display !== 'none') {
        downloadLink.style.display = 'inline-block';
    }
    
    }
    function hideAlert() {
		var alertBox = document.querySelector('.alert-container');
		alertBox.style.visibility = 'hidden';
	}  
</script>
