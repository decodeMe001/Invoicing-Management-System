<script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
<<<<<<< HEAD
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="http://localhost:80/vsystems/assets/img/preloader.gif" style="height:25px;" /></div>');

		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
=======
		$('#modal_ajax .modal-body').html('<div style="text-align:center; margin-top:200px;"><img src="<?=base_url(); ?>assets/img/preloader.gif" style="height:25px;" /></div>');
		
		$('#modal_ajax').modal('show', {backdrop: 'true'});
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3

		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			method: 'POST',
			success: function(response)
			{
				$('#modal_ajax .modal-body').html(response);
			}
		});
	}

</script>

    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"></h4>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<<<<<<< HEAD
						<span aria-hidden="true">x</span>
=======
						<span aria-hidden="true">×</span>
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
					</button>
                </div>
                <div class="modal-body">
				
                </div>
				<div class="modal-footer">
<<<<<<< HEAD
					Sales & Inventory App 
					[<?php date_default_timezone_set("Africa/Lagos"); echo date("d-m-Y h:i:s A");?>]
=======
					StratumWorld Resources App, 2021.
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
				</div>
            </div>
        </div>
    </div>
	

