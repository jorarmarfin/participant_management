<x-guest-layout>

    @if($type == 'web')
        <livewire:quiz.quiz-web-live :event_id="$event_id" />
    @else
        <livewire:quiz.quiz-formation-live :event_id="$event_id" />
   @endif

</x-guest-layout>
