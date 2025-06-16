import { Alert } from '@/components/alert';
import { Badge } from '@/components/badge';
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
                <div className="flex gap-2">
                    <Badge>New</Badge>
                    <Badge color="primary">New</Badge>
                    <Badge color="secondary">New</Badge>
                    <Badge color="accent">New</Badge>
                    <Badge color="info">New</Badge>
                    <Badge color="success">New</Badge>
                    <Badge color="warning">New</Badge>
                    <Badge color="error">New</Badge>
                </div>
                <div className="flex gap-2">
                    <Badge badgeStyle="dash">New</Badge>
                    <Badge color="primary" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="secondary" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="accent" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="info" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="success" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="warning" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="error" badgeStyle="dash">
                        New
                    </Badge>
                </div>
                <div className="flex gap-2">
                    <Badge badgeStyle="outline">New</Badge>
                    <Badge color="primary" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="secondary" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="accent" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="info" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="success" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="warning" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="error" badgeStyle="outline">
                        New
                    </Badge>
                </div>
                <div className="flex gap-2">
                    <Badge badgeStyle="soft">New</Badge>
                    <Badge color="primary" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="secondary" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="accent" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="info" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="success" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="warning" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="error" badgeStyle="soft">
                        New
                    </Badge>
                </div>
                <div className="flex gap-2">
                    <Badge badgeStyle="ghost">New</Badge>
                    <Badge color="primary" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="secondary" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="accent" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="info" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="success" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="warning" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="error" badgeStyle="ghost">
                        New
                    </Badge>
                </div>
                <div className="flex gap-2">
                    <Loading />
                    <Loading type="dots" />
                    <Loading type="ball" />
                    <Loading type="bars" />
                    <Loading type="ring" />
                    <Loading type="infinity" className="text-primary" />
                </div>
                <div className="flex flex-col gap-4">
                    <Alert color="info" message="Info message" icon />
                    <Alert color="success" message="Success message" icon />
                    <Alert color="warning" message="Warning message" icon />
                    <Alert color="error" message="Error message" icon />
                </div>
                <div className="flex flex-col gap-4">
                    <Alert color="info" message="Info message" alertStyle="soft" />
                    <Alert color="success" message="Success message" alertStyle="soft" />
                    <Alert color="warning" message="Warning message" alertStyle="soft" />
                    <Alert color="error" message="Error message" alertStyle="soft" />
                </div>
                <div className="flex flex-col gap-4">
                    <Alert color="info" message="Info message" alertStyle="outline" />
                    <Alert color="success" message="Success message" alertStyle="outline" />
                    <Alert color="warning" message="Warning message" alertStyle="outline" />
                    <Alert color="error" message="Error message" alertStyle="outline" />
                </div>
            </div>
        </AppLayout>
    );
}
