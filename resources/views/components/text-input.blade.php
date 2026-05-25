@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-200 focus:border-indigo-650 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-650/10 dark:focus:ring-indigo-500/10 rounded-xl transition duration-150 shadow-sm text-sm py-3 px-4']) }}>
