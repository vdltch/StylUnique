import { Icon, Card } from "../../components";
import { __ } from "@wordpress/i18n";
import { mainDemo, demo2, demo3, demo4, demo5, demo6, demo7, demo8 } from "../../components/images";

const StarterSites = () => {
    const cardList = [
        {
            heading: __('Blossom Spa Pro', 'blossom-spa'),
            imageurl: mainDemo,
            buttonUrl: __('https://blossomthemesdemo.com/blossom-spa-pro/', 'blossom-spa'),
        },
        {
            heading: __('Tranquility Yoga (Elementor)', 'blossom-spa'),
            imageurl: demo2,
            buttonUrl: __('https://blossomthemesdemo.com/blossom-spa-pro-2/', 'blossom-spa'),
        },
        {
            heading: __('Blissful Spa (Elementor)', 'blossom-spa'),
            imageurl: demo3,
            buttonUrl: __('https://blossomthemesdemo.com/blossom-spa-pro-3/', 'blossom-spa'),
        },
        {
            heading: __('Beauty Salon (Elementor)', 'blossom-spa'),
            imageurl: demo4,
            buttonUrl: __('https://blossomthemesdemo.com/spa-pro-beauty-salon/', 'blossom-spa'),
        },
        {
            heading: __('Hair Salon (Elementor)', 'blossom-spa'),
            imageurl: demo5,
            buttonUrl: __('https://blossomthemesdemo.com/spa-pro-hair-salon/', 'blossom-spa'),
        },
        {
            heading: __('Yoga', 'blossom-spa'),
            imageurl: demo6,
            buttonUrl: __('https://blossomthemesdemo.com/spa-pro-yoga/', 'blossom-spa'),
        },
        {
            heading: __('Beauty Salon', 'blossom-spa'),
            imageurl: demo7,
            buttonUrl: __('https://blossomthemesdemo.com/spa-pro-salon/', 'blossom-spa'),
        },
        {
            heading: __('Massage Center', 'blossom-spa'),
            imageurl: demo8,
            buttonUrl: __('https://blossomthemesdemo.com/spa-pro-massage/', 'blossom-spa'),
        },

    ]
    return (
        <>
            <Card
                cardList={cardList}
                cardPlace='starter'
                cardCol='three-col'
            />
            <div className="starter-sites-button cw-button">
                <a href={__('https://blossomthemes.com/theme-demo/?theme=blossom-spa-pro&utm_source=blossom_spa&utm_medium=dashboard&utm_campaign=theme_demo', 'blossom-spa')} target="_blank" className="cw-button-btn outline">
                    {__('View All Demos', 'blossom-spa')}
                    <Icon icon="arrowtwo" />
                </a>
            </div>
        </>
    );
}

export default StarterSites;