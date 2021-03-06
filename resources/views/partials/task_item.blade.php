<li class="task-item {{ ($ticket->priority <= 30 ? 'success-element' : '') }}{{ ($ticket->priority > 30 && $ticket->priority <= 40 ? 'warning-element' : '') }}{{ ($ticket->priority > 40 ? 'danger-element' : '') }}" id="{{ $ticket->id }}">
	<i class="pull-right fa fa-angle-double-down fa-lg description-btn"></i>
	<div class="clearfix handle">
		<strong class="ticket-summary">#{{ $ticket->id }}: {{ $ticket->summary }}</strong>
		<div class="hr-line-dashed ticket-description no-padding"></div>
		@if(count($users) > 0)
		<p class="ticket-description"><strong>Project:</strong> {{ $ticket->project->name }}</p>
		@endif
		<p class="ticket-description">{{ $ticket->bugText->description }}</p>

		<div class="hr-line-dashed no-padding"></div>

		<div class="agile-detail">
			<div class="row">
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<i class="fa fa-calendar-o"></i> {{ date('d-m-Y', $ticket->date_submitted) }}
				</div>
				<div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-xs-3" title="Reacties">
					<i class="fa fa-comment-o"></i> {{ $ticket->bugnote->count() }}
				</div>
				@if($ticket->fields->where('id', 1, false)->first() && !empty($ticket->fields->where('id', 1, false)->first()->pivot->value))
					<div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-xs-3 no-padding-left" title="Urenindicatie">
						<i class="fa fa-clock-o"></i> <span class="ticket-est-time">{{ ($ticket->fields->where('id', 1, false)->first()->pivot->value) }}</span>
					</div>
				@endif
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xl-3 col-lg-5 col-md-6 col-sm-6 col-xs-6">
					<a href="http://in2008.nl/mantis/view.php?id={{ $ticket->id }}" class="btn btn-xs btn-primary" target="_blank"><i class="fa fa-eye"></i>  Toon ticket</a>
				</div>
				<div class="col-xl-4 col-lg-offset-1 col-lg-6 col-md-6 col-sm-6 col-xs-6">
					@if(count($users) > 0)
					{!! Form::select('assign_to_id', $users, $ticket->handler_id, ['class' => 'ticket-assign-to']) !!}
					@else
						<p><strong>{{ $ticket->project->name }}</strong> </p>
					@endif
				</div>
			</div>
		</div>
	</div>
</li>