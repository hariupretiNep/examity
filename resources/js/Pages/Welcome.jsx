import { Link, Head } from '@inertiajs/inertia-react';
import GuestLayout from '@/Layouts/GuestLayout';

export default function Welcome(props) {
    return (
        <GuestLayout>
            <Head title="Welcome" />
                <div className="fixed top-0 right-0 px-6 py-4 sm:block">
                    {props.auth.user ? (
                        <Link href={route('dashboard')} className="text-sm text-gray-700 dark:text-gray-500">
                            Dashboard
                        </Link>
                    ) : (
                        <>
                            <Link href={route('login')} className="text-sm text-gray-700 dark:text-gray-500">
                                Log in
                            </Link>

                            <Link
                                href={route('register')}
                                className="ml-4 text-sm text-gray-700 dark:text-gray-500"
                            >
                                Register
                            </Link>
                        </>
                    )}
                </div>
                <div className="max-w-lg sm:px-6 lg:px-2">
                Welcome to Examity, It's a online platform for examination.
                </div>
        </GuestLayout>
    );
}
