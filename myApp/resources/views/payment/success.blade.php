<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg text-center">
        <!-- Success Icon -->
        <div class="flex justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-500" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 12l2 2l4 -4"></path>
                <circle cx="12" cy="12" r="10"></circle>
            </svg>
        </div>

        <!-- Success Message -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Payment Successful!</h1>
        <p class="text-gray-600 mb-2">Thank you for your purchase. Your payment was processed successfully.</p>
        <p class="text-gray-600">Transaction ID:</p>
        <p class="text-gray-800 font-semibold mb-6">{{ $transactionID }}</p>



        <!-- Action Button -->
        <a href="{{ route('user.dashboard') }}"
            class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out">
            Go to Dashboard
        </a>
    </div>
</body>

</html>
