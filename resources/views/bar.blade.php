<div class="fixed bottom-0 w-full">
    <div class="w-full max-w-4xl mx-auto px-4">
        <div class="bg-white shadow p-4 rounded-lg mb-4 flex items-center justify-between">
            <div class="flex items-center">
                <span class="text-sm">{{ $text ?? 'This website makes use of cookies' }}</span>
            </div>

            <div>
                <button data-refuse-cookies class="text-sm text-gray-500 border rounded-md transition duration-100 transition-shadow px-2 py-1 mr-2 shadow-sm hover:shadow-md">{{ $cancel ?? 'Decline' }}</button>
                <button data-accept-cookies class="text-sm text-white bg-green-500 border border-green-600 rounded-md transition duration-100 transition-shadow px-2 py-1 shadow-sm hover:shadow-md">{{ $accept ?? 'Accept' }}</button>
            </div>
        </div>
    </div>
</div>
