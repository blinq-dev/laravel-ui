@foreach(ui()->notify->getQueue() as $alert)
    <div 
        x-data="{
            open: true,
        }"
        id="popup-modal" 
        tabindex="-1" 
        x-cloak 
        x-show="open"
        class="fixed inset-0 w-full h-full z-50 bg-black/40 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full select-text"
        @keydown.escape="open = false"
        >
        <div class="relative w-full max-w-md max-h-full m-auto mt-4">
            <div class="relative bg-white rounded-2xl shadow dark:bg-c0-700" 
                @if($alert->closable)
                @click.away="open = false"
                @endif
            >
                @if($alert->closable)
                    <button 
                        @click="open = false"
                        type="button" class="absolute top-3 right-2.5 text-c0-900 bg-transparent hover:bg-c0-200 hover:text-c0-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-c0-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        
                        <span class="sr-only">Close modal</span>
                    </button>
                @endif
                <div class="p-6 text-center">
                    @if($alert->icon)
                        <x-icon class='mx-auto mb-2 text-c0-900 w-14 h-14 dark:text-c0-200' id="{{ $alert->icon }}" />
                    @endif
                    <h3 class="mb-1 mt-4 text-xl font-semibold font-normal text-c0-900 dark:text-c0-400">{{ $alert->title }}</h3>
                    @if($alert->message)
                        <p class="text-md">{!! $alert->message !!}</p>
                    @endif
                    <div class="flex justify-center mt-5 gap-1">
                        @foreach($alert->buttons as $button)
                            <x-button type="button" class="{{ $button->colors ?? '' }}" size="lg" @click.stop="{!! $button->action !!}">
                                {{ $button->label }}
                            </x-button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach