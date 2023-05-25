@php
    $notification = session()->get('notification');
@endphp

@if(isset($notification))
    <div id="notify-toast" class="fixed top-5 right-5 p-2 rounded-xl bg-white shadow-2xl z-[3] min-w-[350px] border border-primary-content/30 cursor-pointer" onclick="closeToast(this)">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                @switch($notification['type'])
                    @case('success')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    @break
                    @case('error')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    @break
                    @case('warning')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    @break
                    @case('info')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    @break
                @endswitch
            </div>
            <div class="ml-3 w-0 flex-1 pt-0.5 flex flex-col">
                <p class="text-sm font-bold text-gray-900">
                    {!! $notification['title'] !!}
                </p>
                <p class="text-sm text-gray-700">
                    {!! $notification['message'] !!}
                </p>
            </div>
        </div>
    </div>

    <script>
        const toast = document.getElementById('notify-toast');
        if (toast) {
            setTimeout(() => {
                closeToast(toast);
            }, 5000);
        }

        function closeToast(element) {
            element.classList.add('deactivate');
            setTimeout(() => {
                element.remove()
            }, 500);
        }
    </script>
@endif
