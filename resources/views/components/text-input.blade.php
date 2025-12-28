@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-white/20 dark:border-white/20 bg-[#1a1a1a] dark:bg-[#1a1a1a] text-white dark:text-white placeholder-gray-500 focus:border-[#f53003] dark:focus:border-[#f53003] focus:ring-[#f53003] dark:focus:ring-[#f53003] rounded-lg shadow-sm']) }}>
