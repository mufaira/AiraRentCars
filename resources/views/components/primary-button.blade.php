<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-[#f53003] dark:bg-[#f53003] border border-transparent rounded-lg font-bold text-sm text-white dark:text-white uppercase tracking-widest hover:bg-[#d63000] dark:hover:bg-[#d63000] focus:bg-[#d63000] dark:focus:bg-[#d63000] active:bg-[#b82400] dark:active:bg-[#b82400] focus:outline-none focus:ring-2 focus:ring-[#f53003] focus:ring-offset-2 dark:focus:ring-offset-black transition ease-in-out duration-150 shadow-lg']) }}>
    {{ $slot }}
</button>
