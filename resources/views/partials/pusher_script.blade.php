<script>
	$(function() {
		var pusher = new Pusher('c6ca1d090dec336e071a');
		var channel = pusher.subscribe('refreshChannel'+projectgroup_id+sprint_id+env);

		channel.bind('changeStatus', function(data) {
		    // Ticket count
		    var $target_ticket_count_label = $('#'+data.drop_id+'-ticket-count');
            var $src_ticket_count_label = $('#'+data.src_id+'-ticket-count');
            var target_ticket_count = parseInt($target_ticket_count_label.text());
            var src_ticket_count = parseInt($src_ticket_count_label.text());

            // Estimated time
            var ticket_est_time = parseFloat($('#'+data.id).find('span.ticket-est-time').text());
            var $target_est_time_label = $('#'+data.drop_id +'-est-time-label');
            var $target_est_time = $target_est_time_label.find('.est-time-val');
            var target_est_time_val = parseFloat($target_est_time.text());
            var $src_est_time_label = $('#'+data.src_id +'-est-time-label');
            var $src_est_time = $src_est_time_label.find('.est-time-val');
            var src_est_time_val = parseFloat($src_est_time.text());

			$('#'+data.id+' .ticket-assign-to').val(data.handler);
			if (data.user != user) {
				$('#'+data.id).prependTo('#'+data.drop_id);
			}
			$('.changed-item').removeClass('changed-item');

			$('#'+data.id).addClass('changed-item');

            // Ticket counter
            $target_ticket_count_label.text(target_ticket_count+1);
            $src_ticket_count_label.text(src_ticket_count-1);

            // Estimated time
            var target_outcome = (target_est_time_val + ticket_est_time).toFixed(2);
            var src_outcome = src_est_time_val - ticket_est_time;

            // Float or integer
            if (target_outcome - parseInt(target_outcome) === 0) {
                target_outcome = parseInt(target_outcome);
            } else if ((parseFloat(target_outcome).toFixed(1) - target_outcome) <= 0) {
                target_outcome = parseFloat(target_outcome).toFixed(1);
            } else if ((parseFloat(target_outcome).toFixed(2) - target_outcome) <= 0) {
                target_outcome = parseFloat(target_outcome).toFixed(2);
            } else {
                target_outcome = parseFloat(target_outcome).toFixed(2)
            }
            if (src_outcome - parseInt(src_outcome) === 0) {
                src_outcome = parseInt(src_outcome);
            } else if ((parseFloat(src_outcome).toFixed(1) - src_outcome) <= 0) {
                src_outcome = parseFloat(src_outcome).toFixed(1);
            } else if ((parseFloat(src_outcome).toFixed(2) - src_outcome) <= 0) {
                src_outcome = parseFloat(src_outcome).toFixed(2);
            } else {
                src_outcome = parseFloat(src_outcome).toFixed(2);
            }

            $target_est_time.text(target_outcome);
            $src_est_time.text(src_outcome);

			toastr.info('De status van ticket #'+data.id+' is gewijzigd', 'Update!');
		});

		channel.bind('changeHandler', function(data) {
			$('#'+data.id+' .ticket-assign-to').val(data.handler);
			$('.changed-item').removeClass('changed-item');
			$('#'+data.id).addClass('changed-item');
			toastr.info('Ticket #'+data.id+' is toegewezen aan '+data.handlerName, 'Update!');
		});

	});
</script>