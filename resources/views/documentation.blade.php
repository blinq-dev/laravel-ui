<h2 id="component-{{ str($name)->slug() }}" class="text-2xl font-semibold">{{ $name }}</h2>

<p class="text-lg">
    {{ $description }}
</p>

<div class="flex flex-col gap-5 grow shrink">
    {{-- Preview --}}
    <div class="wire:text-lg mt-8 grow-0 shrink-0">
        <div class="flex flex-col gap-12" x-data="{
            code: '',
            result: '',
            {{-- Default props --}}
            props: {
                @foreach ($defaults as $key => $value)
                    '{{ $key }}': '{{ $value }}', @endforeach
            },
            init() {
                // Load props from local storage
                let props = localStorage.getItem('props-{{ $component }}');
        
                if (props) {
                    this.props = JSON.parse(props);
                }
        
                this.$watch('props', () => {
                    this.render();
        
                    // Save props to local storage
                    localStorage.setItem('props-{{ $component }}', JSON.stringify(this.props));
                }, { deep: true });
        
                this.render();
            },
            render() {
                let request = '/blinq-ui/docs/example/{{ $component }}';
                let defaults = @js($defaults);
        
                // Returns a json (post request)
                fetch(request, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            props: {
                                ...defaults,
                                ...this.props,
                            }
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.code = data.code;
                        this.result = data.result;
                    })
            }
        
        }">
            {{-- All the props --}}
            <div class="flex flex-col flex-wrap gap-2">
                @foreach ($props as $prop)
                    <div class="flex flex-row items-center gap-4">
                        @php
                            $name = $prop['name'];
                            $type = $types[$prop['type']] ?? [];
                            $typeType = $type['type'] ?? '';
                            $typeOptions = $type['options'] ?? [];
                        @endphp

                        @if ($typeType === 'options')
                            <label class="text-left text-sm mr-4 w-32 shrink-0">{{ $name }}</label>
                            <x-select x-model="props.{{ $name }}" size="sm" class="grow">
                                @foreach ($typeOptions as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                                <option value="">(null)</option>
                                <option value="_empty_">(empty)</option>
                            </x-select>
                        @else
                            <label class="text-left text-sm mr-4 w-32 shrink-0">{{ $name }}</label>
                            <x-input x-model="props.{{ $name }}" size="sm" class="grow" />
                        @endif
                    </div>
                @endforeach
            </div>
            {{-- Preview --}}
            <div class="flex gap-10 mb-10 flex-col">
                {{-- Preview element --}}
                <div class="rounded-xl" x-html="result"></div>
                {{-- Preview code --}}
                <x-textarea :copyable="true" class="font-mono w-full border-gray text-black rounded-xl text-sm" x-model="code" rows="2"></x-textarea>
                <x-textarea :copyable="true" class="font-mono w-full border-gray text-black rounded-xl text-sm" x-model="result" rows="2"></x-textarea>
            </div>
        </div>
    </div>

    <div class="flex-shrink overflow-x-auto max-w-[300px] sm:max-w-[300px] md:max-w-[400px] lg:max-w-[700px] xl:max-w-[1000px] 2xl:max-w-[1200px]">
        <table class="min-w-full text-left text-sm font-light grow">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th scope="col" class="px-4 py-1">Name</th>
                    <th scope="col" class="px-4 py-1">Type</th>
                    <th scope="col" class="px-4 py-1">Options/Modifiers</th>
                    <th scope="col" class="px-4 py-1">Description</th>
                    <th scope="col" class="px-4 py-1">Example</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($props as $prop)
                    @php
                        $type = $types[$prop['type']] ?? [];
                        $example = str($type['example'] ?? '')
                            ->replace('#component#', $component)
                            ->replace('#prop#', $prop['name']);
                    @endphp
                    <tr class="border-b dark:border-neutral-500">
                        <td class="break-all whitespace-nowrap px-4 py-1">{{ $prop['name'] }}</td>
                        <td class="break-all whitespace-nowrap px-4 py-1">{{ $prop['type'] }}</td>
                        <td class="break-all whitespace-nowrap px-4 py-1">
                            <div x-data="{ expand: false }">
                                @if (($type['modifiers'] ?? []) || ($type['options'] ?? []))
                                    <button class="text-c2" x-on:click="expand = !expand">
                                        <span x-show="!expand">view</span>
                                        <span x-show="expand">hide</span>
                                    </button>
                                    <div x-show="expand">
                                        @foreach ($type['modifiers'] ?? [] as $mod)
                                            <div>.{{ $mod }}</div>
                                        @endforeach
                                        @foreach ($type['options'] ?? [] as $mod)
                                            <div>{{ $mod }}</div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="break-all whitespace-nowrap px-4 py-1">
                            {{ $type['description'] ?? '' }}
                            {{ $prop['description'] }}
                        </td>
                        <td class="break-all whitespace-nowrap px-4 py-1">
                            @if ((string) $example)
                                {{ $example }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
