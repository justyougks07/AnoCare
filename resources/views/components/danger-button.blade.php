<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-xl font-medium text-sm text-white shadow-soft-lg hover:shadow-lg hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all ease-in-out duration-300 active:scale-95']) }}>
    {{ $slot }}
</button>
