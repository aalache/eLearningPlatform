<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Error</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Optional: Add any additional custom styles here */
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md text-center">
        <!-- Error Icon -->
        <div class="flex justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle>
                <path d="M15 9l-6 6m0-6l6 6" stroke="currentColor" stroke-width="2"></path>
            </svg>

        </div>

        <!-- Error Message -->
        <h1 class="text-3xl font-bold text-red-600 mb-4">Oops! Something Went Wrong.</h1>
        <p class="text-gray-700 mb-4">We encountered an error while processing your payment. Please try again or contact
            support if the problem persists.</p>

        <!-- Action Button -->
        <a href="{{ route('user.courses.index') }}"
            class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out">
            Go Back
        </a>

        <!-- Optional: Add additional support contact information -->
        <div class="mt-6">
            <p class="text-gray-600">Need help? <a href="mailto:support@example.com"
                    class="text-blue-500 hover:underline">Contact Support</a></p>
        </div>
    </div>
</body>

</html>
