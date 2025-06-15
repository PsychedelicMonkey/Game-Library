import { Button } from '@/components/button';
import { ImageHero, LoginHero } from '@/components/hero';
import { Loading } from '@/components/loading';
import { AppLayout } from '@/layouts/app-layout';
import { SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

export default function Home() {
    const { auth } = usePage<SharedData>().props;

    return (
        <AppLayout>
            <Head title="Home Page" />

            {auth.user ? <ImageHero /> : <LoginHero />}

            <div className="mx-auto min-h-screen max-w-7xl space-y-6 p-4 lg:p-6">
                <div className="flex gap-2">
                    <Button>Hello</Button>
                    <Button color="primary">Hello</Button>
                    <Button color="secondary">Hello</Button>
                    <Button color="accent">Hello</Button>
                    <Button color="info">Hello</Button>
                    <Button color="success">Hello</Button>
                    <Button color="error">Hello</Button>
                    <Button color="warning">Hello</Button>
                </div>
                Outline
                <div className="flex gap-2">
                    <Button buttonStyle="outline">Hello</Button>
                    <Button color="primary" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="outline">
                        Hello
                    </Button>
                </div>
                Soft
                <div className="flex gap-2">
                    <Button buttonStyle="soft">Hello</Button>
                    <Button color="primary" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="soft">
                        Hello
                    </Button>
                </div>
                Dash
                <div className="flex gap-2">
                    <Button buttonStyle="dash">Hello</Button>
                    <Button color="primary" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="dash">
                        Hello
                    </Button>
                </div>
                Link
                <div className="flex gap-2">
                    <Button buttonStyle="link">Hello</Button>
                    <Button color="primary" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="link">
                        Hello
                    </Button>
                </div>
                Ghost
                <div className="flex gap-2">
                    <Button buttonStyle="ghost">Hello</Button>
                    <Button color="primary" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="ghost">
                        Hello
                    </Button>
                </div>
                <div>
                    <Loading />
                    <Loading type="dots" />
                    <Loading type="ball" />
                    <Loading type="bars" />
                    <Loading type="ring" />
                    <Loading type="infinity" className="text-primary" />
                </div>
            </div>
        </AppLayout>
    );
}
