import { cpSync, mkdirSync, rmSync } from 'node:fs';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const source = resolve(root, 'node_modules/swagger-ui-dist');
const destination = resolve(root, 'public/api-docs/swagger-ui-dist');
const assets = [
    'LICENSE',
    'NOTICE',
    'swagger-ui.css',
    'swagger-ui-bundle.js',
    'swagger-ui-bundle.js.LICENSE.txt',
    'swagger-ui-standalone-preset.js',
    'swagger-ui-standalone-preset.js.LICENSE.txt',
];

rmSync(destination, { recursive: true, force: true });
mkdirSync(destination, { recursive: true });

for (const asset of assets) {
    cpSync(resolve(source, asset), resolve(destination, asset));
}
