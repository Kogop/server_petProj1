import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

if (process.env.NODE_ENV === 'development') {
    console.log('Running in development mode');
} else {
    console.log('Running in production mode');
}

export default function test() {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    test
                </h2>
            }
        >
            <Head title="test" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            You're kokoko2
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
