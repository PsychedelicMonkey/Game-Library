import { AppLayout } from '@/layouts/app-layout';
import AccountForm from '@/pages/settings/forms/account-form';
import ProfileForm from '@/pages/settings/forms/profile-form';
import UpdatePasswordForm from '@/pages/settings/forms/update-password-form';
import UploadAvatarForm from '@/pages/settings/forms/upload-avatar-form';
import { Head } from '@inertiajs/react';

export default function Profile() {
    return (
        <AppLayout>
            <Head title="Profile" />

            {/* name of each tab group should be unique */}
            <div className="tabs-border tabs">
                <input type="radio" name="profile_tabs" className="tab" aria-label="Account Settings" defaultChecked />
                <div className="tab-content p-4">
                    <div className="mx-auto max-w-7xl p-4 lg:p-6">
                        <h1 className="mb-4 text-3xl font-semibold">Account Settings</h1>

                        <AccountForm />
                    </div>
                </div>

                <input type="radio" name="profile_tabs" className="tab" aria-label="Profile Settings" />
                <div className="tab-content p-4">
                    <div className="mx-auto max-w-7xl p-4 lg:p-6">
                        <h1 className="mb-4 text-3xl font-semibold">Profile Settings</h1>

                        <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <ProfileForm />
                            <UploadAvatarForm />
                        </div>
                    </div>
                </div>

                <input type="radio" name="profile_tabs" className="tab" aria-label="Change Password" />
                <div className="tab-content p-4">
                    <div className="mx-auto max-w-7xl p-4 lg:p-6">
                        <h1 className="mb-4 text-3xl font-semibold">Change Password</h1>

                        <UpdatePasswordForm />
                    </div>
                </div>

                <input type="radio" name="profile_tabs" className="tab" aria-label="Manage Subscription" />
                <div className="tab-content p-4">
                    <div className="mx-auto max-w-7xl p-4 lg:p-6">
                        <h1 className="text-3xl font-semibold">Manage Subscription</h1>

                        {/*    Content*/}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
