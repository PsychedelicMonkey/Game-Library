import { Footer } from '@/components/footer';
import { Drawer } from '@/components/ui/drawer';
import type { PropsWithChildren } from 'react';

function AppLayout({ children }: PropsWithChildren) {
    return (
        <Drawer>
            <main className="min-h-screen pt-14">{children}</main>

            <Footer />
        </Drawer>
    );
}

export { AppLayout };
