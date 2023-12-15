<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        /* Google Drive style dashboard */
        .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 3.5rem); /* Adjust this value according to your header height */
            background-color: #f5f5f5;
        }

        .dashboard-content {
            max-width: 800px;
            width: 100%;
            padding: 40px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4285f4;
        }

        .dashboard-message {
            font-size: 20px;
            color: #333;
            margin-bottom: 40px;
        }

        .dashboard-cta {
            display: flex;
            justify-content: center;
        }

        .dashboard-button {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            background-color: #4285f4;
            color: #fff;
            font-size: 18px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dashboard-button:hover {
            background-color: #3367d6;
        }
    </style>

    <div class="dashboard-container">
        <div class="dashboard-content">
            <div class="dashboard-title">
                {{ __('Welcome to Your Dashboard') }}
            </div>
            <table>
                <!-- print the data from shared files -->
            </table>
            <div class="dashboard-message">
                {{ __("You're logged in!") }}
            </div>
            <div class="dashboard-cta">
                <a href="{{ route('file.list') }}" class="dashboard-button">Go to My Files</a>
            </div>
        </div>
    </div>
</x-app-layout>
