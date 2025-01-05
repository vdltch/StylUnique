import { Icon, Sidebar, Card, Heading } from "../../components";
import { __ } from '@wordpress/i18n';

const Homepage = () => {
    const cardLists = [
        {
            iconSvg: <Icon icon="site" />,
            heading: __('Site Identity', 'blossom-spa'),
            buttonText: __('Customize', 'blossom-spa'),
            buttonUrl: cw_dashboard.custom_logo
        },
        {
            iconSvg: <Icon icon="colorsetting" />,
            heading: __("Color Settings", 'blossom-spa'),
            buttonText: __('Customize', 'blossom-spa'),
            buttonUrl: cw_dashboard.colors
        },
        {
            iconSvg: <Icon icon="layoutsetting" />,
            heading: __("Layout Settings", 'blossom-spa'),
            buttonText: __('Customize', 'blossom-spa'),
            buttonUrl: cw_dashboard.layout
        },
        {
            iconSvg: <Icon icon="instagramsetting" />,
            heading: __("Instagram Settings", 'blossom-spa'),
            buttonText: __('Customize', 'blossom-spa'),
            buttonUrl: cw_dashboard.instagram
        },
        {
            iconSvg: <Icon icon="generalsetting" />,
            heading: __("General Settings"),
            buttonText: __('Customize', 'blossom-spa'),
            buttonUrl: cw_dashboard.general
        },
        {
            iconSvg: <Icon icon="footersetting" />,
            heading: __('Footer Settings', 'blossom-spa'),
            buttonText: __('Customize', 'blossom-spa'),
            buttonUrl: cw_dashboard.footer
        }
    ];

    const proSettings = [
        {
            heading: __('Header Layouts', 'blossom-spa'),
            para: __('Choose from different unique header layouts.', 'blossom-spa'),
            buttonText: __('Learn More', 'blossom-spa'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Layouts', 'blossom-spa'),
            para: __('Choose layouts for blogs, banners, posts and more.', 'blossom-spa'),
            buttonText: __('Learn More', 'blossom-spa'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Sidebar', 'blossom-spa'),
            para: __('Set different sidebars for posts and pages.', 'blossom-spa'),
            buttonText: __('Learn More', 'blossom-spa'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Top Bar Settings', 'blossom-spa'),
            para: __('Show a notice or newsletter at the top.', 'blossom-spa'),
            buttonText: __('Learn More', 'blossom-spa'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Boost your website performance with ease.', 'blossom-spa'),
            heading: __('Performance Settings', 'blossom-spa'),
            buttonText: __('Learn More', 'blossom-spa'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Choose typography for different heading tags.', 'blossom-spa'),
            heading: __('Typography Settings', 'blossom-spa'),
            buttonText: __('Learn More', 'blossom-spa'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Import the demo content to kickstart your site.', 'blossom-spa'),
            heading: __('One Click Demo Import', 'blossom-spa'),
            buttonText: __('Learn More', 'blossom-spa'),
            buttonUrl: cw_dashboard?.get_pro
        }
    ];

    const sidebarSettings = [
        {
            heading: __('We Value Your Feedback!', 'blossom-spa'),
            icon: "star",
            para: __("Your review helps us improve and assists others in making informed choices. Share your thoughts today!", 'blossom-spa'),
            imageurl: <Icon icon="review" />,
            buttonText: __('Leave a Review', 'blossom-spa'),
            buttonUrl: cw_dashboard.review
        },
        {
            heading: __('Knowledge Base', 'blossom-spa'),
            para: __("Need help using our theme? Visit our well-organized Knowledge Base!", 'blossom-spa'),
            imageurl: <Icon icon="documentation" />,
            buttonText: __('Explore', 'blossom-spa'),
            buttonUrl: cw_dashboard.docmentation
        },
        {
            heading: __('Need Assistance? ', 'blossom-spa'),
            para: __("If you need help or have any questions, don't hesitate to contact our support team. We're here to assist you!", 'blossom-spa'),
            imageurl: <Icon icon="supportTwo" />,
            buttonText: __('Submit a Ticket', 'blossom-spa'),
            buttonUrl: cw_dashboard.support
        }
    ];

    return (
        <>
            <div className="customizer-settings">
                <div className="cw-customizer">
                    <div className="video-section">
                        <div className="cw-settings">
                            <h2>{__('Blossom Spa Tutorial', 'blossom-spa')}</h2>
                        </div>
                        <iframe src="https://www.youtube.com/embed/UVWkWkuh7GU?si=4ew7TQ2gs_ktOdg6" title={__( 'How to Create a Spa and Salon Website in 2023 | Blossom Spa Free WordPress Theme', 'blossom-spa' )} frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerPolicy="strict-origin-when-cross-origin" allowFullScreen></iframe>
                    </div>
                    <Heading
                        heading={__( 'Quick Customizer Settings', 'blossom-spa' )}
                        buttonText={__( 'Go To Customizer', 'blossom-spa' )}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={cardLists}
                        cardPlace='customizer'
                        cardCol='three-col'
                    />
                    <Heading
                        heading={__( 'More features with Pro version', 'blossom-spa' )}
                        buttonText={__( 'Go To Customizer', 'blossom-spa' )}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={proSettings}
                        cardPlace='cw-pro'
                        cardCol='two-col'
                    />
                    <div className="cw-button">
                        <a href={cw_dashboard?.get_pro} target="_blank" className="cw-button-btn primary-btn long-button">{__('Learn more about the Pro version', 'blossom-spa')}</a>
                    </div>
                </div>
                <Sidebar sidebarSettings={sidebarSettings} openInNewTab={true} />
            </div>
        </>
    );
}

export default Homepage;