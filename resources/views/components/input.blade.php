@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['type' => 'text', 'class' => 'rounded-md shadow-sm dark:bg-gray-900 border-gray-300 dark:border-gray-700']) !!}>
