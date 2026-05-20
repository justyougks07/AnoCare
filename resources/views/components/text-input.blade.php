@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 border border-slate-200 bg-white rounded-xl text-slate-900 placeholder-slate-400 shadow-soft focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 disabled:bg-slate-50 disabled:text-slate-500 disabled:cursor-not-allowed']) }}>
