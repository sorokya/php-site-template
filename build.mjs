import * as esbuild from 'esbuild';

const ctx = await esbuild.context({
  entryPoints: ['css/global.css', 'js/global.js'],
  bundle: true,
  outdir: 'public',
  entryNames: '[ext]/[name]',
  minify: true,
  sourcemap: true,
  target: ['es2020'],
});

if (process.argv.includes('--watch')) {
  await ctx.watch();
  console.log('Watching for changes...');
} else {
  await ctx.rebuild();
  await ctx.dispose();
}