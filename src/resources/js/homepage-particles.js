import { tsParticles } from "@tsparticles/engine";
import { loadAll } from "@tsparticles/all";

import options from "../json/particles-config.json";

(async () => {
    await loadAll(tsParticles);

    await tsParticles.load({
        id: "tsparticles",
        options
    });
})();
