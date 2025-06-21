import { AppLayout } from '@/layouts/app-layout';
import AccountForm from '@/pages/settings/account-form';
import ProfileForm from '@/pages/settings/profile-form';
import UpdatePasswordForm from '@/pages/settings/update-password-form';
import { Head } from '@inertiajs/react';

export default function Profile() {
    return (
        <AppLayout>
            <Head title="Profile" />

            {/* name of each tab group should be unique */}
            <div className="tabs-border tabs">
                <input type="radio" name="profile_tabs" className="tab" aria-label="Account Settings" defaultChecked />
                <div className="tab-content border-base-300 bg-base-100 p-10">
                    <div className="mx-auto max-w-7xl p-4 lg:p-6">
                        <h1 className="text-3xl font-semibold">Account Settings</h1>

                        <AccountForm />
                    </div>
                </div>

                <input type="radio" name="profile_tabs" className="tab" aria-label="Profile Settings" />
                <div className="tab-content border-base-300 bg-base-100 p-10">
                    <div className="mx-auto max-w-7xl p-4 lg:p-6">
                        <h1 className="text-3xl font-semibold">Profile Settings</h1>

                        <ProfileForm />
                    </div>
                </div>

                <input type="radio" name="profile_tabs" className="tab" aria-label="Change Password" />
                <div className="tab-content border-base-300 bg-base-100 p-10">
                    <div className="mx-auto max-w-7xl p-4 lg:p-6">
                        <h1 className="text-3xl font-semibold">Change Password</h1>

                        <UpdatePasswordForm />
                    </div>
                </div>

                <input type="radio" name="profile_tabs" className="tab" aria-label="Manage Subscription" />
                <div className="tab-content border-base-300 bg-base-100 p-10">
                    <div className="mx-auto max-w-7xl p-4 lg:p-6">
                        <h1 className="text-3xl font-semibold">Manage Subscription</h1>

                        {/*    Content*/}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
