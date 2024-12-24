<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="miraEmptyMsgPopUp" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
	role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-start modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitleId">Notification</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="alert alert-dismissible d-flex flex-center flex-column">

					<!--begin::Icon-->
					<i class="fa fa-info" aria-hidden="true"></i>
					<!--end::Icon-->
					<!--begin::Content-->
					<div class="mb-5 fw-semibold" id="mainErreurMsg">Text here</div>

				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">Continuer</a>

				</div>
			</div>
		</div>
	</div>
</div>


<!-- Optional: Place to the bottom of scripts -->
<script>
	const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

</script>