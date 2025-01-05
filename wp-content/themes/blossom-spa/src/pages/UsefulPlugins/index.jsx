import { Icon } from "../../components";
import { useState, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

const pluginList = [
    {
        pluginName: __( 'BlossomThemes Toolkit', 'blossom-spa' ),
        description: __("BlossomThemes Toolkit provides you necessary widgets for better and effective blogging.", "blossom-spa"),
        slug: "blossomthemes-toolkit"
    },
    {
        pluginName: __( 'BlossomThemes Email Newsletter', 'blossom-spa' ),
        description: __("Easily add email subscription form to your website using shortcode and widget.", "blossom-spa"),
        slug: "blossomthemes-email-newsletter"
    },
    {
        pluginName: __( 'Regenerate Thumbnails', 'blossom-spa' ),
        description: __("Regenerate the thumbnails for one or more of your image uploads. Useful when changing their sizes or your theme.", "blossom-spa"),
        slug: "regenerate-thumbnails"
    },
    {
        pluginName: __( 'Smash Balloon Social Photo Feed', 'blossom-spa' ),
        description: __("Formerly 'Instagram Feed'. Display clean, customizable, and responsive Instagram feeds from multiple accounts. Supports Instagram oEmbeds.", "blossom-spa"),
        slug: "instagram-feed"
    },
];

const objectExistsInArray = (obj, array) => {
    return array.some((el) => el.slug === obj.slug);
}

const UsefulPlugins = () => {
    const [buttonState, setButtonState] = useState(() => {
        const initialState = {};
        pluginList.forEach(plugin => {
            initialState[plugin.slug] = 'Install';
        });
        return initialState;
    });

    const [activateUrls, setActivateUrls] = useState({});

    useEffect(() => {
        const activePlugins = cw_dashboard.activePlugins;
        const inactivePlugins = cw_dashboard.inactivePlugins;
        const newButtonState = {};

        // Set state for active plugins
        activePlugins.forEach(plugin => {
            if (objectExistsInArray(plugin, pluginList)) {
                newButtonState[plugin.slug] = 'Activated';
            }
        });

        // Set state for inactive plugins
        inactivePlugins.forEach(plugin => {
            if (objectExistsInArray(plugin, pluginList)) {
                newButtonState[plugin.slug] = 'Activate';
            }
        });

        setButtonState(prevState => ({
            ...prevState,
            ...newButtonState
        }));

        const urls = {};
        inactivePlugins.forEach((plugin) => {
            if (objectExistsInArray(plugin, pluginList)) {
                const url = plugin.url.replace(/&amp;/g, '&');
                urls[plugin.slug] = url;
            }
        });

        setActivateUrls(urls);
    }, []);

    const installPlugin = (slug) => {
        setButtonState((prevState) => ({
            ...prevState,
            [slug]: 'Installing...'
        }));

        wp.updates.installPlugin({
            slug: slug,
            success: (response) => {
                setActivateUrls((prevUrls) => ({
                    ...prevUrls,
                    [slug]: response.activateUrl
                }));
                setButtonState((prevState) => ({
                    ...prevState,
                    [slug]: 'Activate'
                }));
            },
            error: (error) => {
                console.error(error);
                setButtonState((prevState) => ({
                    ...prevState,
                    [slug]: 'Install'
                }));
            }
        });
    }

    const activatePlugin = async (slug) => {
        setButtonState((prevState) => ({
            ...prevState,
            [slug]: 'Activating...'
        }));

        const url = activateUrls[slug];
        if (url) {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        _wpnonce: new URL(url).searchParams.get('_wpnonce'),
                        action: 'activate',
                        plugin: new URL(url).searchParams.get('plugin'),
                    }).toString(),
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                setButtonState((prevState) => ({
                    ...prevState,
                    [slug]: 'Activated'
                }));
            } catch (error) {
                setButtonState((prevState) => ({
                    ...prevState,
                    [slug]: 'Activate'
                }));
            }
        }
    }

    return (
        <div className="cw-plugin-list-wrapper">
            {pluginList.map((plugin, index) => (
                <div className="cw-plugin-list" key={index}>
                    <div className="plugin-detail">
                        <div className="cw-plugin-title">
                            <Icon icon='pluginList' label={plugin.pluginName} />
                        </div>
                        <p className="description">{plugin.description}</p>
                    </div>
                    <div className="insert-button">
                        {buttonState[plugin.slug] === 'Install' && (
                            <button className="cw-button-btn outline" onClick={() => installPlugin(plugin.slug)}>
                                {__('Install', 'blossom-spa')}
                            </button>
                        )}
                        {buttonState[plugin.slug] === 'Installing...' && (
                            <button className="cw-button-btn outline" disabled>
                                {__('Installing...', 'blossom-spa')}
                            </button>
                        )}
                        {buttonState[plugin.slug] === 'Activate' && (
                            <button className="cw-button-btn outline" onClick={() => activatePlugin(plugin.slug)}>
                                {__('Activate', 'blossom-spa')}
                            </button>
                        )}
                        {buttonState[plugin.slug] === 'Activating...' && (
                            <button className="cw-button-btn outline" disabled>
                                {__('Activating...', 'blossom-spa')}
                            </button>
                        )}
                        {buttonState[plugin.slug] === 'Activated' && (
                            <button className="cw-button-btn primary-btn deactivate" disabled>
                                {__('Activated', 'blossom-spa')}
                            </button>
                        )}
                    </div>
                </div>
            ))}
        </div>
    );
}

export default UsefulPlugins;