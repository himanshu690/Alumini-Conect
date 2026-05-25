<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-750 hover:to-blue-750 text-white font-bold rounded-xl shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 transition-all duration-150 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-sm tracking-wide']) }}>
    {{ $slot }}
</button>
